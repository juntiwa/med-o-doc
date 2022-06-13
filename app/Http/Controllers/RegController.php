<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\Jobunit;
use App\Models\Letterreg;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class RegController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regs = Letterreg::orderby('regdate', 'desc')->paginate(50);
        $types = Type::all();

        // for search input
        $regyears = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();
        $sregfrom = $request->get('sregfrom');
        $sregto = $request->get('sregto');

        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->program_name = 'med_edu';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->action = Auth::user()->username.' เข้าสู่หน้า "ลงทะเบียนส่งหนังสือ"';

        $dt = Carbon::now();
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('regdoc', compact('regs', 'types', 'regyears', 'sregfrom', 'sregto'));
    }

    public function selectSearchfrom(Request $request)
    {
        $typeid = $request->post('typeid');
        $sregfrom = $request->post('sregfrom');
        $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();

        $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
        foreach ($unit as $list) {
            // $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';

            if ($sregfrom == $list->unitid) {
                $html .= '<option id="option" value="'.$list->unitid.'" selected>'.$list->unitname.'</option>';
            } else {
                $html .= '<option id="option" value="'.$list->unitid.'" >'.$list->unitname.'</option>';
            }
            echo $list->unitid.'<br>';
        }
        echo $html;
    }

    public function selectSearchto(Request $request)
    {
        $typeid = $request->post('typeid');
        $sregto = $request->post('sregto');
        $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
        $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
        foreach ($unit as $list) {
            // $html .= '<option id="option" value="' . $list->unitid . '">' . $list->unitname . '</option>';
            if ($sregto == $list->unitid) {
                $html .= '<option id="option" value="'.$list->unitid.'" selected>'.$list->unitname.'</option>';
            } else {
                $html .= '<option id="option" value="'.$list->unitid.'" >'.$list->unitname.'</option>';
            }
            echo $list->unitid.'<br>';
        }
        echo $html;
    }

    public function autocompleteSearch(Request $request)
    {
        /* $search = $request->search;
        if ($search == '') {
            $autocomplate = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->limit(20)->get();
        } else {
            $autocomplate = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->where('unitname', 'like', '%'.$search.'%')->limit(20)->get();
        }

        $response = [];
        foreach ($autocomplate as $autocomplate) {
            $response[] = ['value' => $autocomplate->unitid,
               'label' => $autocomplate->unitname, ];
        }
        echo json_encode($response);
        exit; */
         $search = $request->search;

        $data = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->where('unitname', 'like', '%'.$search.'%')->limit(20)->get();

         $response = [];
        foreach ($data as $data) {
            $response[] = ['value' => $data->unitid,
               'label' => $data->unitname, ];
        }
        echo json_encode($response);
    }

    /**
     * serach regis doc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function searchRegis(Request $request)
    {
        $regtype = $request->get('regtype');
        $sregfrom = $request->get('sregfrom');
        $iregfrom = $request->get('idfrom');
        $sregto = $request->get('sregto');
        $iregto = $request->get('idto');
        $regtitle = $request->get('regtitle');
        $frommonth = $request->get('frommonth');
        $tomonth = $request->get('tomonth');
        $fromyear = $request->get('fromyear');
        $toyear = $request->get('toyear');

        $searchregs = Letterreg::orderby('regdate', 'desc');

        if ($regtype != '') {
            $searchregs = $searchregs->where('regtype', $regtype);
        }

        if ($sregfrom != '') {
            $l = strlen($sregfrom);
            // Log::info($l);
            if ($l == 1) {
                $ls = '0'.$sregfrom;
            } else {
                $ls = $sregfrom;
            }
            // Log::info($ls);
            $searchregs = $searchregs->where('regfrom', $ls);
        }

        if ($iregfrom != '') {
            Log::info('f'.$iregfrom);

            $searchregs = $searchregs->where('regfrom', $iregfrom);
        }

        if ($sregto != '') {
            $l = strlen($sregto);
            // Log::info($l);
            if ($l == 1) {
                $lsto = '0'.$sregto;
            } else {
                $lsto = $sregto;
            }
            $searchregs = $searchregs->where('regto', $lsto);
        }

        if ($iregto != '') {
            Log::info('t'.$iregto);

            $searchregs = $searchregs->where('regto', $iregto);
        }

        if ($regtitle != '') {
            $searchregs = $searchregs->where('regtitle', 'LIKE', '%'.$regtitle.'%');
        }

        if ($frommonth != '' && $tomonth != '') {
            $searchregs = $searchregs->whereBetween(DB::raw('MONTH(regdate)'), [$frommonth, $tomonth]);
        }

        if ($fromyear != '' && $toyear != '') {
            $searchregs = $searchregs->whereBetween(DB::raw('Year(regdate)'), [$fromyear, $toyear]);
        }

        // Log::info($searchregs);
        $searchregs = $searchregs->paginate(50);
        $types = Type::all();

        // for search input
        $regyears = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();

        // old input
        $input = $request->flash();

        // แสดงข้อมูลค้นหาเอกสาร
        $jobunits = Jobunit::all();
        $letterunits = Letterunit::all();
        // ชนิดหนังสือ
        if ($regtype != null) {
            foreach ($types as $type) {
                if ($regtype == $type->typeid) {
                    $typename = $type->typename;
                    if ($regtype == 0) {
                        if ($sregfrom == null && $sregto == null) {
                            $regfrom = '-';
                            $regto = '-';
                        } elseif ($sregfrom != null && $sregto == null) {
                            foreach ($jobunits as $jobunit) {
                                if ($sregfrom == $jobunit->unitid) {
                                    $regfrom = $jobunit->unitname;
                                }
                                $regto = '-';
                            }
                        } elseif ($sregfrom == null && $sregto != null) {
                            foreach ($jobunits as $jobunit) {
                                $regfrom = '-';
                                if ($sregto == $jobunit->unitid) {
                                    $regto = $jobunit->unitname;
                                }
                            }
                        } else {
                            foreach ($jobunits as $jobunit) {
                                if ($sregfrom == $jobunit->unitid) {
                                    $regfrom = $jobunit->unitname;
                                }
                                if ($sregto == $jobunit->unitid) {
                                    $regto = $jobunit->unitname;
                                }
                            }
                        }
                    } else {
                        //   $iregfrom = Letterunit::where('iregfrom',$iregfrom);
                        if ($iregfrom == null && $iregto == null) {
                            $regfrom = '-';
                            $regto = '-';
                        } elseif ($iregfrom != null && $iregto == null) {
                            $regfrom = $iregfrom;
                            $regto = '-';
                        } elseif ($iregfrom == null && $iregto != null) {
                            $regfrom = '-';
                            $regto = $iregto;
                        } else {
                            $regfrom = $iregfrom;
                            $regto = $iregto;
                        }
                    }
                }
            }
        } else {
            $typename = '-';
            $regfrom = '-';
            $regto = '-';
        }

        // เดือน
        switch ($frommonth) {
         case '01':
            $fmonth = 'มกราคม';
            break;
         case '02':
            $fmonth = 'กุมภาพันธ์';
            break;
         case '03':
            $fmonth = 'มีนาคม';
            break;
         case '04':
            $fmonth = 'เมษายน';
            break;
         case '05':
            $fmonth = 'พฤษภาคม';
            break;
         case '06':
            $fmonth = 'มิถุนายน';
            break;
         case '07':
            $fmonth = 'กรกฎาคม';
            break;
         case '08':
            $fmonth = 'สิงหาคม';
            break;
         case '09':
            $fmonth = 'กันยายน';
            break;
         case '10':
            $fmonth = 'ตุลาคม';
            break;
         case '11':
            $fmonth = 'พฤศจิกายน';
            break;
         case '12':
            $fmonth = 'ธันวาคม';
            break;
         default:
            $fmonth = '-';
      }

        switch ($tomonth) {
         case '01':
            $tmonth = 'มกราคม';
            break;
         case '02':
            $tmonth = 'กุมภาพันธ์';
            break;
         case '03':
            $tmonth = 'มีนาคม';
            break;
         case '04':
            $tmonth = 'เมษายน';
            break;
         case '05':
            $tmonth = 'พฤษภาคม';
            break;
         case '06':
            $tmonth = 'มิถุนายน';
            break;
         case '07':
            $tmonth = 'กรกฎาคม';
            break;
         case '08':
            $tmonth = 'สิงหาคม';
            break;
         case '09':
            $tmonth = 'กันยายน';
            break;
         case '10':
            $tmonth = 'ตุลาคม';
            break;
         case '11':
            $tmonth = 'พฤศจิกายน';
            break;
         case '12':
            $tmonth = 'ธันวาคม';
            break;
         default:
            $tmonth = '-';
      }

        // ปี
        if ($fromyear != null) {
            $fyear = $fromyear + 543;
        } else {
            $fyear = '-';
        }

        if ($toyear != null) {
            $tyear = $toyear + 543;
        } else {
            $tyear = '-';
        }
        $searchLog = ' ชนิดหนังสือ : '.$typename.' จาก  : '.$regfrom.' ถึง  : '.$regto.' หัวเรื่อง  : '.$regtitle.
         ' เมื่อ  : เดือน '.$fmonth.'ปี '.$fyear.' ถึง  : เดือน '.$tmonth.'ปี '.$tyear;
        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->program_name = 'med_edu';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->action = Auth::user()->username.' ค้นหาเอกสาร "ลงทะเบียนส่งหนังสือ"'.$searchLog;

        $dt = Carbon::now();
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        return view('regdoc', compact(
            'searchregs',
            'types',
            'regyears',
            'sregfrom',
            'sregto',
            'input'
        ));
    }

    public function openfile(Request $request, $year, $regdoc)
    {
        $doc = Letterreg::where('regrecid', $regdoc)->first();
        $filename = $doc->regdoc;
        $path = 'files/'.$year.'/'.$filename;

        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->program_name = 'med_edu';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agenzt');
        $log_activity->action = Auth::user()->username.' เปิดไฟล์ '.$filename;

        $dt = Carbon::now();
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

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
        $path = 'files/'.$year.'/'.$filename;

        $log_activity = new activityLog;
        $log_activity->username = Auth::user()->username;
        $log_activity->program_name = 'med_edu';
        $log_activity->url = URL::current();
        $log_activity->method = $request->method();
        $log_activity->user_agent = $request->header('user-agent');
        $log_activity->action = Auth::user()->username.' เปิดไฟล์ '.$filename;

        $dt = Carbon::now();
        $log_activity->date_time = date('d-m-Y H:i:s');
        $log_activity->save();

        if (Storage::exists($path)) {
            return Storage::response($path);
        } else {
            // dd('File is Not Exists');
            abort(404);
        }
    }
}
