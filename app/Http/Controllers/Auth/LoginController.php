<?php

namespace App\Http\Controllers\Auth;

use App\Contracts\AuthUserAPI;
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
                //  toastr()->info('เข้าสู่ระบบอยู่แล้ว', 'การเข้าสู่ระบบ');
                Toastr::info('เข้าสู่ระบบอยู่แล้ว', 'Success!!');

                return Redirect::route('documents');
            } else {
                return view('auth.login');
            }
        } else {
            $units = Unit::orderby('unitname', 'asc')->get();

            return view('auth.startapp', ['units' => $units]);
        }
    }

    public function authenticate(Request $request, AuthUserAPI $api)
    {
        $sirirajUser = $api->authenticate($request->username, $request->password);
        // return $sirirajUser;
        if ($sirirajUser['reply_code'] != 0) {
            $errors = ['message' => $sirirajUser['reply_text']];
            Log::critical($request->username . ' ' . $sirirajUser['reply_text']);

            return Redirect::back()->withErrors($errors)->withInput($request->all());
        } else {
            $checkMember = Member::where('org_id', $sirirajUser['org_id'])->where('status', 'Active')->first();
            if (!$checkMember) {
                Log::critical($sirirajUser['full_name'] . ' ไม่มีสิทธิ์เข้าถึงระบบ');
                abort(403);
            } else {
                // dd('ok');
                $checkRegisterUser = User::where('org_id', $sirirajUser['org_id'])->first();
                Auth::login($checkRegisterUser);
                $full_name = Auth::user()->full_name;
                if ($checkRegisterUser->username == null) {
                    $units = Unit::orderBy('unitname', 'asc')->get();
                    //  toastr()->info('ลงทะเบียนเพื่อเข้าใช้งานระบบ', 'ลงทะเบียนระบบ');
                    Toastr::info('ลงทะเบียนเพื่อเข้าใช้งานระบบ', 'Register');

                    return view('auth.register', ['sirirajUser' => $sirirajUser, 'units' => $units]);
                } else {
                    if ($checkRegisterUser->username != $sirirajUser['login'] || $checkRegisterUser->full_name != $sirirajUser['full_name']) {
                        $updateUser = User::where('org_id', $checkMember->org_id)->first();
                        $updateUser->username = $sirirajUser['login'];
                        $updateUser->full_name = $sirirajUser['full_name'];
                        $updateUser->save();
                    }

                    $expires = $sirirajUser['password_expires_in_days'];
                    session()->put('expires', $expires);

                    $validated['username'] = Auth::user()->username;
                    $validated['full_name'] = Auth::user()->full_name;
                    $validated['office_name'] = Auth::user()->office_name;
                    $validated['action'] = 'เข้าสู่ระบบ';
                    $validated['type'] = 'view';
                    $validated['url'] = URL::current();
                    $validated['method'] = $request->method();
                    $validated['user_agent'] = $request->header('user-agent');
                    $validated['date_time'] = date('d-m-Y H:i:s');
                    LogActivity::insert($validated);

                    Log::info($full_name . ' เข้าสู่ระบบสำเร็จ');

                    return Redirect::route('documents');
                }
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

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'เริ่มใช้งานระบบ';
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);

        Log::info($full_name . ' ลงทะเบียนเริ่มต้นใช้งานสำเร็จ');

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
        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'ออกจากระบบ';
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);

        Auth::logout();
        Session::forget('user');
        session()->forget('expires');

        //   toastr()->success('ออกจากระบบสำเร็จ', 'แจ้งเตือน');
        Toastr::success('ออกจากระบบสำเร็จ', 'Success!!');

        return Redirect::route('login');
    }
}
