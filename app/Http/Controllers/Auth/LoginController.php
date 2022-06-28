<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\AuthUserAPI;
use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use App\Models\Member;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $checkRecordMember = Member::count();
        if ($checkRecordMember != 0) {
            if (Auth::check()) {
                toastr()->success('เข้าสู่ระบบสำเร็จ', 'แจ้งเตือน');

                return view('document');
            } else {
                return view('auth.login');
            }
        } else {
            $units = Unit::orderby('unitname', 'asc')->get();

            return view('auth.startapp', ['units'=>$units]);
        }
    }

    public function authenticate(Request $request, AuthUserAPI $api)
    {
        $sirirajUser = $api->authenticate($request->username, $request->password);
        if ($sirirajUser['reply_code'] != 0) {
            $errors = ['message' => $sirirajUser['reply_text']];
            Log::critical($request->username . ' ' . $sirirajUser['reply_text']);
            toastr()->error('ตรวจสอบข้อมูล username หรือ password', 'แจ้งเตือน');

            return Redirect::back()->withErrors($errors)->withInput($request->all());
        }

        $checkMember = Member::where('org_id', $sirirajUser['org_id'])->where('status', 'Active')->first();
        if (!$checkMember) {
            Log::critical($sirirajUser['full_name'] . ' No access rights');
            abort(403);
        } else {
            // dd('ok');
            $checkRegisterUser = User::where('org_id', $sirirajUser['org_id'])->first();
            Auth::login($checkRegisterUser);
            $full_name = Auth::user()->full_name;
            if ($checkRegisterUser->username == null) {
                $units = Unit::orderBy('unitname', 'asc')->get();

                return view('auth.register', ['sirirajUser'=>$sirirajUser, 'units'=>$units]);
            } else {
                if ($checkRegisterUser->username != $sirirajUser['login'] || $checkRegisterUser->full_name != $sirirajUser['full_name']) {
                    $updateUser = User::where('org_id', $checkMember->org_id)->first();
                    $updateUser->username = $sirirajUser['login'];
                    $updateUser->full_name = $sirirajUser['full_name'];
                    $updateUser->save();
                }
                $log_activity = new LogActivity;
                $log_activity->username = Auth::user()->username;
                $log_activity->full_name = Auth::user()->full_name;
                $log_activity->office_name = Auth::user()->office_name;
                $log_activity->action = 'เข้าสู่ระบบ';
                $log_activity->type = 'login';
                $log_activity->url = URL::current();
                $log_activity->method = $request->method();
                $log_activity->user_agent = $request->header('user-agent');
                $log_activity->date_time = date('d-m-Y H:i:s');
                $log_activity->save();

                Log::info($full_name . ' login success');
                toastr()->success('เข้าสู่ระบบสำเร็จ', 'แจ้งเตือน');

                return Redirect::route('documents');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //   dd('ok');
        $org_id = $request->get('org_id');
        $username = $request->get('login');
        $full_name = $request->get('full_name');
        $office_name = $request->get('office_name');
        $unit = Unit::where('unitid', $office_name)->first();

        $members = new Member;
        $members->org_id = $org_id;
        $members->is_admin = 1;
        $members->status = 'Active';
        $members->save();

        $users = new User;
        $users->org_id = $org_id;
        $users->username = $username;
        $users->full_name = $full_name;
        $users->office_name = $office_name;
        $users->office_name = $unit->unitname;
        $users->is_admin = 1;
        $users->status = 'Active';
        $users->save();

        $log_activity = new LogActivity;
        $log_activity->username = $username;
        $log_activity->full_name = $full_name;
        $log_activity->office_name = $unit->unitname;
        $log_activity->action = 'เริ่มใช้งานระบบ';
        $log_activity->type = 'register';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        Log::info($full_name . ' register start app success');
        toastr()->info('ลงทะเบียนเริ่มต้นใช้งานสำเร็จ เข้าสู่ระบบเพื่อเริ่มใช้งาน', 'แจ้งเตือน');

        return Redirect::route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function logout(Request $request)
    {
        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'ออกจากระบบ';
        $log_activity->type = 'logout';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        Auth::logout();
        Session::forget('user');
        toastr()->success('ออกจากระบบสำเร็จ', 'แจ้งเตือน');

        return Redirect::route('login');
    }
}
