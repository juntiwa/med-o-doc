<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ActivityLogsExport;
use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
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
      $this->middleware(['auth','admin']);
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

      Log::info($request);

      $user = new User;
      // Getting values from the blade template form
      $user->username =  $request->username;
      $user->is_admin = $request->permis;
      $user->status = 'Active';
      $user->save();
      return redirect()->route('permission');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id)
   {
      $user = User::find($id);
      return view('usermanage.editPermission', compact('user'));
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request, $id)
   {
      // Validation for required fields (and using some regex to validate our numeric value)
      $request->validate([
         'role' => 'required',
         'status' => 'required',
      ]);
      $user = User::find($id);
      // Getting values from the blade template form
      $user->is_admin = $request->role;
      $user->status = $request->status;
      $user->save();

      $login_activity = new activityLog;
      $login_activity->username = Auth::user()->username;
      $login_activity->program_name = 'med_edu';
      $login_activity->subject = 'Admin edit permission successfully';
      $login_activity->url = URL::current();
      $login_activity->method = $request->method();
      $login_activity->ip = $request->ip();
      $login_activity->user_agent = $request->header('user-agent');
      $login_activity->action = 'Edit permission user';
      $dt = Carbon::now();
      $login_activity->date_time = $dt->toDayDateTimeString();
      $login_activity->save();

      return redirect('permission')->with('success', 'User updated.'); // -> resources/views/stocks/index.blade.php
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function deleteActivity(Request $request)
   {
      $activityLog = activityLog::truncate();
      $maxId = DB::table('activity_logs')->max('id');
      DB::statement('ALTER TABLE users AUTO_INCREMENT=' . intval($maxId + 1) . ';');

      $login_activity = new activityLog;
      $login_activity->username = Auth::user()->username;
      $login_activity->program_name = 'med_edu';
      $login_activity->subject = 'Admin delete activity log successfully';
      $login_activity->url = URL::current();
      $login_activity->method = $request->method();
      $login_activity->ip = $request->ip();
      $login_activity->user_agent = $request->header('user-agent');
      $login_activity->action = 'Delete activity log';
      $dt = Carbon::now();
      $login_activity->date_time = $dt->toDayDateTimeString();
      $login_activity->save();
      return redirect()->route('activitylog');
   }

   /**
    * @return \Illuminate\Support\Collection
    */
   public function export(Request $request)
   {
      $time_now = Carbon::now()->format('Y_m_d_H:i:s');
      $filename = 'activity_log_'.$time_now.'.xlsx';

      $login_activity = new activityLog;
      $login_activity->username = Auth::user()->username;
      $login_activity->program_name = 'med_edu';
      $login_activity->subject = 'Admin export data activity log successfully';
      $login_activity->url = URL::current();
      $login_activity->method = $request->method();
      $login_activity->ip = $request->ip();
      $login_activity->user_agent = $request->header('user-agent');
      $login_activity->action = 'Export data activity log';
      $dt = Carbon::now();
      $login_activity->date_time = $dt->toDayDateTimeString();
      $login_activity->save();

      return Excel::download(new ActivityLogsExport, $filename  );
   }
}
