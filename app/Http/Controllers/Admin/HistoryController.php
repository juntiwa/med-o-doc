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


        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'เข้าดูประวัติการใช้งาน';
        $validated['type'] = 'view';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);


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

        $validated['username'] = Auth::user()->username;
        $validated['full_name'] = Auth::user()->full_name;
        $validated['office_name'] = Auth::user()->office_name;
        $validated['action'] = 'Export file activity log';
        $validated['type'] = 'export file';
        $validated['url'] = URL::current();
        $validated['method'] = $request->method();
        $validated['user_agent'] = $request->header('user-agent');
        $validated['date_time'] = date('d-m-Y H:i:s');
        LogActivity::insert($validated);


        return Excel::download(new LogActivitysExport, $filename);
    }
}
