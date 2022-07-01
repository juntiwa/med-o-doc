<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Letterreg;
use App\Models\Letterunit;
use App\Models\LogActivity;
use App\Models\Month;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $monthsSelectionForm = Month::all();
        $yearsSelectionForm = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();
        $typesSelectionForm = Type::all();
        $documentCount = Letterreg::count();

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เข้าสู่หน้าค้นหาเอกสาร';
        $log_activity->type = 'view';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('document', ['monthsSelectionForm'=>$monthsSelectionForm, 'yearsSelectionForm'=>$yearsSelectionForm,
                                 'typesSelectionForm'=>$typesSelectionForm, 'documentCount'=>$documentCount]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Request $request)
    {
        // for input
        $monthsSelectionForm = Month::all();
        $yearsSelectionForm = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();
        $typesSelectionForm = Type::all();
        $jobunitsLog = Jobunit::all();
        $letterunitsLog = Letterunit::all();
        $monthsLog = Month::all();
        $documentCount = Letterreg::count();

        $type = $request->get('type');
        $unitInner = $request->get('unitInner');
        $idunitOutter = $request->get('idunitOutter');
        $title = $request->get('title');
        $startMonth = $request->get('startMonth');
        $startYear = $request->get('startYear');
        $endMonth = $request->get('endMonth');
        $endYear = $request->get('endYear');

        $resultDocument = Letterreg::orderBy('regdate', 'desc');
        if ($type != '') {
            foreach ($typesSelectionForm as $typelog) {
                if ($type == $typelog->typeid) {
                    $searchLog = ' ชนิดหนังสือ : ' . $typelog->typename;
                }
            }
            // logger($searchLog);
            $resultDocument = $resultDocument->where('regtype', $type);
        }

        if ($unitInner != '') {
            $length = strlen($unitInner);
            if ($length != '') {
                $zero = '0' . $unitInner;
            } else {
                $zero = $unitInner;
            }
            foreach ($jobunitsLog as $unitInnerlog) {
                if ($unitInner == $unitInnerlog->unitis) {
                    $searchLog = ' หน่วยงานที่ส่ง : ' . $unitInnerlog->unitname;
                }
            }
            $resultDocument = $resultDocument->where('regfrom', $zero);
        }

        if ($idunitOutter != '') {
            foreach ($letterunitsLog as $unitOutterlog) {
                if ($idunitOutter == $unitOutterlog->unitis) {
                    $searchLog = ' หน่วยงานที่ส่ง : ' . $unitOutterlog->unitname;
                }
            }
            $resultDocument = $resultDocument->where('regfrom', $idunitOutter);
        }

        if ($title != '') {
            $resultDocument = $resultDocument->where('regtitle', 'LIKE', '%' . $title . '%');
            if ($type != '') {
                $searchLog = $searchLog . ' หัวเรื่อง  : ' . $title;
            } else {
                $searchLog = ' หัวเรื่อง  : ' . $title;
            }
        }

        if ($startMonth != '' && $endMonth != '') {
            foreach ($monthsLog as $monthLog) {
                if ($startMonth == $monthLog->id) {
                    $searchLog = ' หน่วยงานที่ส่ง : ' . $monthLog->name_th;
                }
                if ($endMonth == $monthLog->id) {
                    $searchLog = ' ถึง ' . $monthLog->name_th;
                }
            }

            $resultDocument = $resultDocument->whereBetween(DB::raw('MONTH(regdate)'), [$startMonth, $endMonth]);
        }

        if ($startYear != '' && $endYear != '') {
            $searchLog = ' ระหว่างปี : ' . $startYear + 543 . ' ถึง ' . $endYear + 543;
            $resultDocument = $resultDocument->whereBetween(DB::raw('Year(regdate)'), [$startYear, $endYear]);
        }
        $resultCount = $resultDocument->count();
        $resultDocument = $resultDocument->paginate(50);
        toastr()->info('ค้นหาสำเร็จ ผลลัพท์ข้อมูล '.$resultCount.' เรื่อง', 'Import');

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'ค้นหาเอกสาร ' . $searchLog;
        $log_activity->type = 'search';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('document', ['monthsSelectionForm'=>$monthsSelectionForm, 'yearsSelectionForm'=>$yearsSelectionForm,
                                 'typesSelectionForm'=>$typesSelectionForm, 'resultDocument'=>$resultDocument,
                                  'resultCount'=>$resultCount, 'documentCount'=>$documentCount, ])->with($request->flash());
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

    public function selectUnitInner(Request $request)
    {
        $typeid = $request->post('typeid');
        $unitinner = $request->post('unitinner');
        $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
        logger($unitinner);
        $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
        foreach ($unit as $list) {
            // $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';

            if ($unitinner == $list->unitid) {
                $html .= '<option id="option" value="' . $list->unitid . '" selected>' . $list->unitname . '</option>';
            } else {
                $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';
            }
            echo $list->unitid . '<br>';
        }
        echo $html;
    }

    public function autocompleteUnitOutter(Request $request)
    {
        $search = $request->get('search');
        $data = Letterunit::select('unitname as value', 'unitid as id')
              ->where('unitname', 'LIKE', '%' . $search . '%')
              ->orderBy('unitname')
              ->limit(20)->get();

        return response()->json($data);
    }

    public function openfile(Request $request, $year, $regdoc)
    {
        $doc = Letterreg::where('regrecid', $regdoc)->first();
        $filename = $doc->regdoc;
        $path = 'files/' . $year . '/' . $filename;

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เปิดไฟล์เอกสาร ' . $filename;
        $log_activity->type = 'search';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        $full_name = Auth::user()->full_name;
        //   Log::info($full_name . ' เปิดไฟล์เอกสาร รหัส ' . $regdoc . ' ชื่อไฟล์ ' . $filename);

        if (Storage::exists($path)) {
            return Storage::response($path);
        } else {
            // dd('File is Not Exists');
            abort(404);
        }
    }

    public function openfile2(Request $request, $year, $regdoc)
    {
        $doc = Letterreg::where('regrecid', $regdoc)->first();
        $filename = $doc->regdoc2;
        $path = 'files/' . $year . '/' . $filename;

        $log_activity = new LogActivity;
        $log_activity->username = Auth::user()->username;
        $log_activity->full_name = Auth::user()->full_name;
        $log_activity->office_name = Auth::user()->office_name;
        $log_activity->action = 'เปิดไฟล์เอกสาร ' . $filename;
        $log_activity->type = 'search';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        $full_name = Auth::user()->full_name;
        //   Log::info($full_name . 'เปิดไฟล์เอกสาร ' . $regdoc . ' ' . $filename);
        if (Storage::exists($path)) {
            return Storage::response($path);
        } else {
            // dd('File is Not Exists');
            abort(404);
        }
    }
}
