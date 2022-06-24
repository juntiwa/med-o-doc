<?php

namespace App\Http\Controllers\Admin;

use App\APIs\CheckAccountAPI;
use App\Http\Controllers\Controller;
use App\Models\activityLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class CheckUserController extends Controller
{
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

        return view('admin.checkuser', compact('permiss'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, CheckAccountAPI $api)
    {
        $checkAcc = $api->checkuser($request->sapid);

        return $checkAcc;

        //   return back()->with($checkAcc);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
