<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Imports\MembersImport;
use App\Models\activityLog;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class MemberImportController extends Controller
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
    public function index()
    {
        //
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
        $request->validate([
            'member_file' => 'required',
        ]);

        try {
            Excel::import(new MembersImport, request()->file('member_file'));
            Toastr::success('Import ข้อมูลผู้ใช้งานสำเร็จ', 'แจ้งเตือน', ['positionClass' => 'toast-top-right']);

            Log::info(Auth::user()->full_name.' Import ข้อมูลผู้ใช้งาน');

            $log_activity = new activityLog();
            $log_activity->username = Auth::user()->username;
            $log_activity->full_name = Auth::user()->full_name;
            $log_activity->office_name = Auth::user()->office_name;
            $log_activity->action = 'Import ข้อมูลผู้ใช้งาน';
            $log_activity->type = 'save';
            $log_activity->url = URL::current();
            $log_activity->method = $request->method();
            $log_activity->user_agent = $request->header('user-agent');
            $log_activity->date_time = date('d-m-Y H:i:s');
            $log_activity->save();

            return Redirect::route('permission')->with('status', 'The file has been imported in laravel');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);

            return redirect()->back()->with('import_errors', $failures);
        }
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
