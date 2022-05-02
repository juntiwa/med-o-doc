<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ActivityLogsExport;
use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
   /**
    * Create a new controller instance.
    *
    * @return void
    */
   public function __construct()
   {
      $this->middleware('auth');
   }
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $activityLog = activityLog::paginate(50);
      return view('usermanage.activity_log', compact('activityLog'));
   }

   public function permis()
   {
      $permiss = User::paginate(50);
      return view('usermanage.permission', compact('permiss'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      $request->validate([
         'username' => 'required|string|max:255',
         'permis' => 'required',
      ]);

      User::create([
         'username'      => $request->username,
         'role_name'      => $request->permis,
      ]);
      return redirect()->route('permission');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function delete($id)
   {
      $permis = User::where('id', $id)->firstorfail()->delete();

      return redirect()->route('permission');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function deleteActivity()
   {
      $activityLog = activityLog::truncate();
      $maxId = DB::table('activity_logs')->max('id');
      DB::statement('ALTER TABLE users AUTO_INCREMENT=' . intval($maxId + 1) . ';');
      return redirect()->route('activitylog');
   }

   /**
    * @return \Illuminate\Support\Collection
    */
   public function export()
   {
      $time_now = Carbon::now()->format('Y_m_d');
      $filename = 'activity_log_'.$time_now.'.xlsx';
      return Excel::download(new ActivityLogsExport, $filename  );
   }
}
