<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Member;
use App\Models\Unit;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class ManageController extends Controller
{
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
        $userPermission = User::rightJoin('members', 'users.org_id', '=', 'members.org_id')->paginate(50);

        $log_activity = new LogActivity;
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

        return view('admin.manage.user', ['userPermission'=>$userPermission]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.addUser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sapid1 = $request->post('sapid1');
        $sapid2 = $request->post('sapid2');
        $sapid3 = $request->post('sapid3');
        $sapid4 = $request->post('sapid4');
        $sapid5 = $request->post('sapid5');
        $sapid6 = $request->post('sapid6');
        $permission1 = $request->post('permission1');
        $permission2 = $request->post('permission2');
        $permission3 = $request->post('permission3');
        $permission4 = $request->post('permission4');
        $permission5 = $request->post('permission5');
        $permission6 = $request->post('permission6');

        if ($permission1 == 1 || $permission2 == 1 || $permission3 == 1 || $permission4 == 1 || $permission5 == 1 || $permission6 == 1) {
            $permission = 'ผู้ดูแลระบบ';
        } else {
            $permission = 'ผู้ใช้งานทั่วไป';
        }
        $users = Member::where('org_id', $sapid1)->exists();
        if ($users == '') {
            $data = [
               ['org_id' => $sapid1 ,'is_admin' => $permission1, 'status' => 'Active'],
            ];
            // return $data;
            $logdata = ' "'.$sapid1.' สิทธิ์ '.$permission.'"';
            if ($sapid2 != '') {
                $data[] = [ 'org_id' => $sapid2 ,'is_admin' => $permission2, 'status' => 'Active', ];
                $logdata .= ' ,"'.$sapid2.' สิทธิ์ '.$permission.'"';
            }
            if ($sapid3 != '') {
                $data[] = [ 'org_id' => $sapid3 ,'is_admin' => $permission3, 'status' => 'Active', ];
                $logdata .= ' ,"'.$sapid3.' สิทธิ์ '.$permission.'"';
            }
            if ($sapid4 != '') {
                $data[] = [ 'org_id' => $sapid4 ,'is_admin' => $permission4, 'status' => 'Active', ];
                $logdata .= ' ,"'.$sapid4.' สิทธิ์ '.$permission.'"';
            }
            if ($sapid5 != '') {
                $data[] = [ 'org_id' => $sapid5 ,'is_admin' => $permission5, 'status' => 'Active', ];
                $logdata .= ' ,"'.$sapid5.' สิทธิ์ '.$permission.'"';
            }
            if ($sapid6 != '') {
                $data[] = [ 'org_id' => $sapid6 ,'is_admin' => $permission6, 'status' => 'Active', ];
                $logdata .= ' ,"'.$sapid6.' สิทธิ์ '.$permission.'"';
            }
            Member::insert($data);
            User::insert($data);
            Log::critical(Auth::user()->full_name.' add permission user '.$logdata);
            // toastr()->success('เพิ่มผู้ใช้งานสำเร็จ', 'แจ้งเตือน');
            Toastr::success('เพิ่มผู้ใช้งานสำเร็จ', 'Success!!');

            $log_activity = new LogActivity;
            $log_activity->username = Auth::user()->username;
            $log_activity->full_name = Auth::user()->full_name;
            $log_activity->office_name = Auth::user()->office_name;
            $log_activity->action = 'เพิ่มสิทธิ์ผู้ใช้งาน ' . $logdata;
            $log_activity->type = 'create';
            $log_activity->url = URL::current();
            $log_activity->method = $request->method();
            $log_activity->user_agent = $request->header('user-agent');
            $log_activity->date_time = date('d-m-Y H:i:s');
            $log_activity->save();
        } else {
            if (Member::where('org_id', $sapid1)->exists()) {
                $errors['massage1'] = ['massage1' => $sapid1.' มีรหัสพนักงานนี้อยู่แล้ว'];
            }
            if ($sapid2 != '') {
                if (Member::where('org_id', $sapid2)->exists()) {
                    $errors['massage2'] = ['massage2' => $sapid2.' มีรหัสพนักงานนี้อยู่แล้ว'];
                }
            }
            if ($sapid3 != '') {
                if (Member::where('org_id', $sapid3)->exists()) {
                    $errors['massage3'] = ['massage3' => $sapid3.' มีรหัสพนักงานนี้อยู่แล้ว'];
                }
            }
            if ($sapid4 != '') {
                if (Member::where('org_id', $sapid4)->exists()) {
                    $errors['massage4'] = ['massage4' => $sapid4.' มีรหัสพนักงานนี้อยู่แล้ว'];
                }
            }
            if ($sapid5 != '') {
                if (Member::where('org_id', $sapid5)->exists()) {
                    $errors['massage5'] = ['massage5' => $sapid5.' มีรหัสพนักงานนี้อยู่แล้ว'];
                }
            }
            if ($sapid6 != '') {
                if (Member::where('org_id', $sapid6)->exists()) {
                    $errors['massage6'] = ['massage6' => $sapid6.' มีรหัสพนักงานนี้อยู่แล้ว'];
                }
            }
            return Redirect::back()->withErrors($errors)->withInput($request->all());
        }
        return Redirect::route('manages');
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
        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'ดูข้อมูลรหัสพนักงาน ' .$sapid;
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();
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

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เข้าสู่หน้าแก้ไขข้อมูลของรหัสพนักงาน ' .$org_id;
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('admin.manage.editUser', ['user'=>$user,'units'=>$units]);
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
        $member = Member::where('org_id', $org_id)->first();
        $member->org_id = $request->org_id;
        $member->is_admin = $request->is_admin;
        $member->status = $request->status;
        $member->save();
        
        $user = User::where('org_id', $org_id)->first();
        $unit = Unit::where('unitid', $request->office_name)->first();
        // Getting values from the blade template form
        $user->org_id = $request->org_id;
        $user->office_name = $unit->unitname;
        $user->is_admin = $request->is_admin;
        $user->status = $request->status;
        $user->save();

        Log::critical(Auth::user()->full_name.' edit user SAPID : '.$org_id);
        //   toastr()->info('แก้ไขข้อมูลผู้ใช้งานรหัส '.$org_id.' เสร็จแล้ว', 'ผลการแก้ไข');
        Toastr::success('แก้ไขข้อมูลผู้ใช้งานรหัส '.$org_id.' เสร็จแล้ว', 'Success!!');

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'แก้ไขข้อมูลของรหัสพนักงาน ' .$org_id;
        $log_activity->type = 'update';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return Redirect::route('manages');
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
