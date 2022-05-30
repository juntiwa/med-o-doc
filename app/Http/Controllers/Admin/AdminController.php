<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ActivityLogsExport;
use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
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
   public function index(Request $request)
   {
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin เข้าสู่หน้า activity log';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      $activityLog = activityLog::paginate(50);
      
      return view('usermanage.activity_log', compact('activityLog'));
   }

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function permis(Request $request)
   {
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin เข้าสู่หน้าข้อมูลสิทธิ์ผู้ใช้งาน';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      $permiss = User::paginate(50);
      return view('usermanage.permission', compact('permiss'));
   }

   public function add(Request $request)
   {
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();

      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin เข้าสู่หน้าเพิ่มข้อมูลสิทธิ์ผู้ใช้งาน';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      $permiss = User::paginate(50);
      return view('usermanage.addPermission', compact('permiss'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create(Request $request)
   {
      $user = $request->post('username');
      $permis = $request->post('permis');
      $user1 = $request->post('username1');
      $permis1 = $request->post('permis1');
      $user2 = $request->post('username2');
      $permis2 = $request->post('permis2');
      $user3 = $request->post('username3');
      $permis3 = $request->post('permis3');
      $user4 = $request->post('username4');
      $permis4 = $request->post('permis4');
      $user5 = $request->post('username5');
      $permis5 = $request->post('permis5');

      // Log::info($request);
      $users = User::where('username', '=', $user);
      if ($user1 != '') {
         $users  = $users->orWhere('username', '=', $user1);
      }
      $users = $users->first();
      if($users === null){
         $data = [
            ['username' => $user, 'is_admin' => $permis, 'status' => 'Active'], 
         ];

         if ($user1 != '') {
            $data[] =  ['username' => $user1, 'is_admin' => $permis1, 'status' => 'Active'];
         }
         if ($user2 != '') {
            $data[] =  ['username' => $user2, 'is_admin' => $permis2, 'status' => 'Active'];
         }
         if ($user3 != '') {
            $data[] =  ['username' => $user3, 'is_admin' => $permis3, 'status' => 'Active'];
         }
         if ($user4 != '') {
            $data[] =  ['username' => $user4, 'is_admin' => $permis4, 'status' => 'Active'];
         }
         if ($user5 != '') {
            $data[] =  ['username' => $user5, 'is_admin' => $permis5, 'status' => 'Active'];
         }
         User::insert($data);
         // dd("yes");

      }else{
         if(User::where('username', '=', $user)->exists()){
            $errors['user'] = ['user' => $user . ' มีแล้วชื่อนี้อยู่แล้ว'];
         }
         if ($user1 != '') {
            if (User::where('username', '=', $user1)->exists()) {
               $errors['user1'] =  ['user1' => $user1 . ' มีแล้วชื่อนี้อยู่แล้ว'];
            }
         }
         if ($user2 != '') {
            if (User::where('username', '=', $user2)->exists()) {
               $errors['user2'] =  ['user2' => $user2 . ' มีแล้วชื่อนี้อยู่แล้ว'];
            }
         }
         if ($user3 != '') {
            if (User::where('username', '=', $user3)->exists()) {
               $errors['user3'] =  ['user3' => $user3 . ' มีแล้วชื่อนี้อยู่แล้ว'];
            }
         }
         if ($user4 != '') {
            if (User::where('username', '=', $user4)->exists()) {
               $errors['user4'] =  ['user4' => $user4 . ' มีแล้วชื่อนี้อยู่แล้ว'];
            }
         }
         if ($user5 != '') {
            if (User::where('username', '=', $user5)->exists()) {
               $errors['user5'] =  ['user5' => $user5 . ' มีแล้วชื่อนี้อยู่แล้ว'];
            }
         }
         
         return Redirect::back()->withErrors($errors)->withInput($request->all());
         dd($errors);
      }
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();

      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      return redirect()->route('permission');
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit(Request $request, $id)
   {
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin เข้าสู่หน้าแก้ไขสิทธิ์ผู้ใช้งาน';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

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
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin แก้ไขสิทธิ์ผู้ใช้งาน';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

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

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin ลบข้อมูล activity log';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();
      return redirect()->route('activitylog');
   }

   /**
    * Export data to excel file
    * 
    * @return \Illuminate\Support\Collection
    */
   public function export(Request $request)
   {
      $time_now = Carbon::now()->format('Y_m_d_H:i:s');
      $filename = 'activity_log_'.$time_now.'.xlsx';

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      
      $log_activity->user_agent = $request->header('user-agent');
      $log_activity->action = 'Admin export ข้อมูล activity log';
      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      return Excel::download(new ActivityLogsExport, $filename);
   }
}
