<?php

namespace App\Http\Controllers\Admin;

use App\Exports\LogActivitysExport;
use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class HistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'abilities', 'admin']);
    }

    public function index(Request $request)
    {
        $logAvtivitys = LogActivity::orderby('date_time', 'desc')->paginate(50);

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เข้าดูประวัติการใช้งาน';
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('admin.history', ['logAvtivitys' => $logAvtivitys]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function export(Request $request)
    {
        $time_now = Carbon::now()->format('Y_m_d_H:i:s');
        $filename = 'Log_MED_O_Doc_'.$time_now.'.xlsx';
        Log::critical(Auth::user()->full_name.' Export file '.$filename);
        //   toastr()->info('Export file '.$filename.' เสร็จแล้ว', 'ผลการร้องขอ');
        //   Toastr::success('Export file '.$filename.' เสร็จแล้ว', 'Success!!');

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'Export file activity log';
        $log_activity->type = 'export file';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return Excel::download(new LogActivitysExport, $filename);
    }
}
