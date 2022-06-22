<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\Member;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class PermissionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $permiss = User::rightJoin('members', 'users.org_id', '=', 'members.org_id')->paginate(50);
        //   $permiss = Member::paginate(50);

        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เข้าสู่หน้าข้อมูลสิทธิ์ผู้ใช้งาน';
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('admin.permission', compact('permiss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permiss = User::paginate(50);

        return view('admin.addPermission', compact('permiss'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->post('sapid');
        $permis = $request->post('permis');
        $user1 = $request->post('sapid1');
        $permis1 = $request->post('permis1');
        $user2 = $request->post('sapid2');
        $permis2 = $request->post('permis2');
        $user3 = $request->post('sapid3');
        $permis3 = $request->post('permis3');
        $user4 = $request->post('sapid4');
        $permis4 = $request->post('permis4');
        $user5 = $request->post('sapid5');
        $permis5 = $request->post('permis5');

        // Log::info($request);
        $users = Member::where('org_id', '=', $user);
        if ($user1 != '') {
            $users = $users->orWhere('org_id', '=', $user1);
        }
        $users = $users->first();
        if ($users === null) {
            $data = [
               ['org_id' => $user, 'is_admin' => $permis, 'status' => 'Active'],
            ];
            if ($permis == 1 || $permis2 == 1 || $permis3 == 1 || $permis4 == 1 || $permis5 == 1) {
                $permiss = 'ผู้ดูแลระบบ';
            //  Log::info($permiss);
            } else {
                $permiss = 'ผู้ใช้งานทั่วไป';
                //  Log::info($permiss);
            }
            $datas = ' "'.$user.' สิทธิ์ '.$permiss.'"';

            if ($user1 != '') {
                $data[] = ['org_id' => $user1, 'is_admin' => $permis1, 'status' => 'Active'];
                $datas .= ' ,"'.$user1.' สิทธิ์ '.$permiss.'"';
            }
            if ($user2 != '') {
                $data[] = ['org_id' => $user2, 'is_admin' => $permis2, 'status' => 'Active'];
                $datas .= ' ,"'.$user2.' สิทธิ์ '.$permiss.'"';
            }
            if ($user3 != '') {
                $data[] = ['org_id' => $user3, 'is_admin' => $permis3, 'status' => 'Active'];
                $datas .= ' ,"'.$user3.' สิทธิ์ '.$permiss.'"';
            }
            if ($user4 != '') {
                $data[] = ['org_id' => $user4, 'is_admin' => $permis4, 'status' => 'Active'];
                $datas .= ' ,"'.$user4.' สิทธิ์ '.$permiss.'"';
            }
            if ($user5 != '') {
                $data[] = ['org_id' => $user5, 'is_admin' => $permis5, 'status' => 'Active'];
                $datas .= ' ,"'.$user5.' สิทธิ์ '.$permiss.'"';
            }
            Member::insert($data);
            User::insert($data);
            Log::info(Auth::user()->full_name.' เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน '.$datas);

            $log_activity = new activityLog;
            $log_activity->username = Auth::user()->username;
            $log_activity->full_name = Auth::user()->full_name;
            $log_activity->office_name = Auth::user()->office_name;
            $log_activity->action = 'ดูข้อมูล SAPID '.$datas;
            $log_activity->type = 'view';
            $log_activity->url = URL::current();
            $log_activity->method = $request->method();
            $log_activity->user_agent = $request->header('user-agent');
            $log_activity->date_time = date('d-m-Y H:i:s');
            $log_activity->save();
        // dd($data);
        } else {
            if (Member::where('org_id', '=', $user)->exists()) {
                $errors['user'] = ['user' => $user.' มีแล้วชื่อนี้อยู่แล้ว'];
            }
            if ($user1 != '') {
                if (Member::where('org_id', '=', $user1)->exists()) {
                    $errors['user1'] = ['user1' => $user1.' มีแล้วชื่อนี้อยู่แล้ว'];
                }
            }
            if ($user2 != '') {
                if (Member::where('org_id', '=', $user2)->exists()) {
                    $errors['user2'] = ['user2' => $user2.' มีแล้วชื่อนี้อยู่แล้ว'];
                }
            }
            if ($user3 != '') {
                if (Member::where('org_id', '=', $user3)->exists()) {
                    $errors['user3'] = ['user3' => $user3.' มีแล้วชื่อนี้อยู่แล้ว'];
                }
            }
            if ($user4 != '') {
                if (Member::where('org_id', '=', $user4)->exists()) {
                    $errors['user4'] = ['user4' => $user4.' มีแล้วชื่อนี้อยู่แล้ว'];
                }
            }
            if ($user5 != '') {
                if (Member::where('org_id', '=', $user5)->exists()) {
                    $errors['user5'] = ['user5' => $user5.' มีแล้วชื่อนี้อยู่แล้ว'];
                }
            }

            return Redirect::back()->withErrors($errors)->withInput($request->all());
            // dd($errors);
        }

        return redirect()->route('permission');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $sapid = $request->post('sapid');

        //   Log::info('ok');
        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'ดูข้อมูล SAPID '.$sapid;
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return response()->json(['success'=>'Data is successfully added']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $org_id)
    {
        $user = User::where('org_id', $org_id)->first();
        $units = Unit::orderby('unitname', 'asc')->get();

        $sapid = $user->org_id;
        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เข้าสู่หน้าแก้ไขข้อมูลของผู้ใช้งานรหัส '.$sapid;
        $log_activity->type = 'edit';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('admin.editPermission', compact('user', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $org_id)
    {
        // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
         'sapid' => 'required',
         'role' => 'required',
         'status' => 'required',
      ]);
        $member = Member::where('org_id', $org_id)->first();
        $member->org_id = $request->sapid;
        $member->is_admin = $request->role;
        $member->status = $request->status;
        $member->save();

        $user = User::where('org_id', $org_id)->first();
        $unit = Unit::where('unitid', $request->office_name)->first();
        // Getting values from the blade template form
        $user->org_id = $request->sapid;
        $user->office_name = $unit->unitname;
        $user->is_admin = $request->role;
        $user->status = $request->status;
        $user->save();

        $sapid = $user->org_id;

        Log::info(Auth::user()->full_name.' แก้ไขข้อมูลผู้ใช้งานรหัส '.$sapid);

        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'บันทึกการแก้ไขข้อมูลของรหัสผู้ใช้งาน '.$sapid;
        $log_activity->type = 'save';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return Redirect::route('permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
