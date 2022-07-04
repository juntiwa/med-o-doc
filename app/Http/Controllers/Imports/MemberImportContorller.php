<?php

namespace App\Http\Controllers\Imports;

use App\Http\Controllers\Controller;
use App\Imports\MembersImport;
use App\Models\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Maatwebsite\Excel\Facades\Excel;

class MemberImportContorller extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }
    public function import(Request $request)
    {
        $request->validate([
         'member_file' => 'required',
      ]);

        try {
            Excel::import(new MembersImport, request()->file('member_file'));
            
            // toastr()->info('Import ข้อมูลเสร็จสิ้น', 'Import');
            Toastr::success('Import ข้อมูลเสร็จสิ้น', 'Success!!');
            Log::critical(Auth::user()->full_name.' Import file user permission');

            $log_activity = new LogActivity;
            $log_activity->username = Auth::user()->username;
            $log_activity->full_name = Auth::user()->full_name;
            $log_activity->office_name = Auth::user()->office_name;
            $log_activity->action = 'Import ข้อมูลผู้ใช้งาน';
            $log_activity->type = 'import file';
            $log_activity->url = URL::current();
            $log_activity->method = $request->method();
            $log_activity->user_agent = $request->header('user-agent');
            $log_activity->date_time = date('d-m-Y H:i:s');
            $log_activity->save();

            return Redirect::route('manages')->with('status', 'The file has been imported in laravel');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();
            // dd($failures);
            // toastr()->error('ตรวจสอบข้อมูลอีกครั้ง', 'ตรวจสอบข้อมูล');
            Toastr::error('ตรวจสอบข้อมูลอีกครั้ง', 'Error!!');

            return redirect()->back()->with('import_errors', $failures);
        }
    }
}
