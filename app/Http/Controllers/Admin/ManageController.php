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
        $this->middleware(['auth', 'abilities', 'admin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userPermission = User::rightJoin('members', 'users.org_id', '=', 'members.org_id')->paginate(50);
        //   $user = User::where('org_id', $org_id)->first();
        $units = Unit::orderby('unitname', 'asc')->get();

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'เข้าสู่หน้าข้อมูลสิทธิ์ผู้ใช้งาน';
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);


        return view('admin.manage.user', ['userPermission' => $userPermission, 'units'=>$units]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $units = Unit::orderBy('unitname', 'asc')->get();

        return view('admin.manage.addUser', ['units'=> $units]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sapids = $request->sapid;
        $permissions = $request->permission;
        $office_names = $request->office_name;

        $log_activity = [];
        $arrlength = count($sapids);
        //   return $log;
        for ($i = 0; $i < $arrlength; $i++) {
            $datauser[$i] = [
                'org_id' => $sapids[$i],
                'is_admin' => $permissions[$i],
                'office_name' => $office_names[$i]
             ];
            $datamember[$i] = [
                'org_id' => $sapids[$i],
                'is_admin' => $permissions[$i]
            ];
            if ($permissions[$i] == 1) {
                $role = 'ผู้ดูแลระบบ';
                $roleConvert = mb_convert_encoding($role, 'UTF-8', 'UTF-8');
            } else {
                $role = 'ผู้ใช้งานทั่วไป';
                $roleConvert = mb_convert_encoding($role, 'UTF-8', 'UTF-8');
            }
            $log_activity[$i] = new LogActivity([
               'username' => Auth::user()->username,
               'full_name' => Auth::user()->full_name,
               'office_name' => Auth::user()->office_name,
               'action' => 'เพิ่มรหัสรหัสผู้ใช้งาน '.$sapids[$i].' สิทธิ์ '.$roleConvert.' หน่วยงาน '.$office_names[$i],
               'type' => 'create',
               'url' => URL::current(),
               'method' => $request->method(),
               'user_agent' => $request, header('user-agent'),
               'date_time' => date('d-m-Y H:i:s'),
           ]);
        Log::info(Auth::user()->full_name.'เพิ่มรหัสรหัสผู้ใช้งาน '.$sapids[$i].' สิทธิ์ '.$roleConvert . ' หน่วยงาน ' . $office_names[$i].' สำเร็จ');
        }
        Member::insert($datamember);
        User::insert($datauser);
//        Toastr::success('เพิ่มผู้ใช้งานสำเร็จ', 'Success!!');
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

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'ดูข้อมูลรหัสพนักงาน '.$sapid;
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);

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


        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'เข้าสู่หน้าแก้ไขข้อมูลของรหัสพนักงาน '.$org_id;
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);


        return view('admin.manage.editUser', ['user' => $user, 'units' => $units]);
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

        // return $request->office_name;
        $member = Member::where('org_id', $org_id)->first();
        $member->org_id = $request->org_id;
        $member->is_admin = $request->is_admin;
        $member->status = $request->status;
        $member->save();

        $user = User::where('org_id', $org_id)->first();
        // Getting values from the blade template form
        $user->org_id = $request->org_id;
        if ($request->office_name != '') {
            $unit = Unit::where('unitid', $request->office_name)->first();
            $user->office_name = $unit->unitname;
        } else {
            $user->office_name = null;
        }
        $user->is_admin = $request->is_admin;
        $user->status = $request->status;
        $user->save();

        Log::critical(Auth::user()->full_name.' แก้ไขผู้ใช้งาน SAPID : '.$org_id);
        //   toastr()->info('แก้ไขข้อมูลผู้ใช้งานรหัส '.$org_id.' เสร็จแล้ว', 'ผลการแก้ไข');
        Toastr::success('แก้ไขข้อมูลผู้ใช้งานรหัส '.$org_id.' เสร็จแล้ว', 'Success!!');

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'แก้ไขข้อมูลของรหัสพนักงาน '.$org_id;
        $validated['type'] = 'update';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);

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
