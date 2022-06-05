<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\Jobunit;
use App\Models\Letterrec;
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

class RecController extends Controller
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
      $recs = Letterrec::join('letterregs', 'letterrecs.regrecid', '=', 'letterregs.regrecid')
         ->orderby('letterrecs.recdate', 'desc')->paginate(50);
      $types = Type::all();
      
      // for search input
      $recyears = Letterrec::select(DB::raw('YEAR(recdate) recyear'))->groupby(DB::raw('YEAR(recdate)'))->get();
      $srecfrom = $request->get('srecfrom');
      $srecto = $request->get('srecto');

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เข้าสู่หน้า "ทะเบียนหนังสือรับ"';
      } else {
         $log_activity->action = 'User เข้าสู่หน้า "ทะเบียนหนังสือรับ"';
      }

      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      return view('recdoc', compact('recs', 'types', 'recyears', 'srecfrom', 'srecto'));
   }

   public function selectSearchfrom(Request $request)
   {
      $typeid = $request->post('typeid');
      $srecfrom = $request->post('srecfrom');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option value="' . $list->unitid . '">' . $list->unitname . '</option>';
         if ($srecfrom == $list->unitid) {
            $html .= '<option id="option" value="' . $list->unitid . '" selected>' . $list->unitname . '</option>';
         } else {
            $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';
         }
         echo $list->unitid . '<br>';
      }
      echo $html;
   }

   public function selectSearchto(Request $request)
   {
      $typeid = $request->post('typeid');
      $srecto = $request->post('srecto');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option value="' . $list->unitid . '">' . $list->unitname . '</option>';
         if ($srecto == $list->unitid) {
            $html .= '<option id="option" value="' . $list->unitid . '" selected>' . $list->unitname . '</option>';
         } else {
            $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';
         }
         echo $list->unitid . '<br>';
      }
      echo $html;
   }

   public function autocompleteSearch(Request $request)
   {
      $search = $request->search;
      if ($search == '') {
         $autocomplate = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->limit(20)->get();
      } else {
         $autocomplate = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->where('unitname', 'like', '%' . $search . '%')->limit(20)->get();
      }

      $response = array();
      foreach ($autocomplate as $autocomplate) {
         $response[] = array("label" => $autocomplate->unitname);
      }
      echo json_encode($response);
      exit;
   }

   /**
    * serach regis doc
    * 
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function searchRec(Request $request)
   {
      $rectype = $request->get('rectype');
      $srecfrom = $request->get('srecfrom');
      $irecfrom = $request->get('irecfrom');
      $srecto = $request->get('srecto');
      $irecto = $request->get('irecto');
      $rregtitle = $request->get('rregtitle');
      $rfrommonth = $request->get('rfrommonth');
      $rtomonth = $request->get('rtomonth');
      $rfromyear = $request->get('rfromyear');
      $rtoyear = $request->get('rtoyear');

      $units = Letterunit::all();
      foreach ($units as $unit) {
         $unitname = $unit->unitname;
         // Log::info($unitname);
         if (stripos($unitname, $irecfrom) !== FALSE) {
            $fuid = $unit->unitid;
            // Log::info("f" . $fuid);
         }
         if (stripos($unitname, $irecto) !== FALSE) {
            $tuid = $unit->unitid;
            // Log::info("t" . $tuid);
         }
      }
      $searchrecs = Letterrec::join('letterregs', 'letterrecs.regrecid', '=', 'letterregs.regrecid')->orderby('letterrecs.recdate', 'desc');

      if ($rectype != '') {
         $searchrecs  = $searchrecs->where('rectype', $rectype);
      }

      if ($srecfrom != '') {
         $searchrecs  = $searchrecs->where('recfromid', $srecfrom);
      }

      if ($irecfrom != '') {
         $searchrecs  = $searchrecs->where('recfromid', $fuid);
      }

      if ($srecto != '') {
         $searchrecs  = $searchrecs->where('rectoid', $srecto);
      }

      if ($irecto != '') {
         $searchrecs  = $searchrecs->where('rectoid', $tuid);
      }

      if ($rregtitle != '') {
         $searchrecs  = $searchrecs->where('regtitle', 'LIKE', '%' . $rregtitle . '%');
      }

      if ($rfrommonth != '' && $rtomonth != '') {
         $searchrecs  = $searchrecs->whereBetween(DB::raw('MONTH(letterrecs.recdate)'), array($rfrommonth, $rtomonth));
      }
      if ($rfromyear != '' && $rtoyear != '') {
         $searchrecs  = $searchrecs->whereBetween(DB::raw('Year(letterrecs.recdate)'), array($rfromyear, $rtoyear));
      }

      // Log::info($recs);
      $searchrecs  = $searchrecs->paginate(50);
      $types = Type::all();

      // for search input
      $recyears = Letterrec::select(DB::raw('YEAR(recdate) recyear'))->groupby(DB::raw('YEAR(recdate)'))->get();

      // แสดงข้อมูลที่ค้นหา บนตาราง
      $jobunits = Jobunit::all();
      $letterunits = Letterunit::all();

      // ชนิดหนังสือ
      if ($rectype != null) {
         foreach ($types as $type) {
            if ($rectype == $type->typeid) {
               $typename = $type->typename;
               if ($rectype == 0) {
                  if ($srecfrom == null && $srecto == null) {
                     $recfrom = "-";
                     $recto = "-";
                  } elseif ($srecfrom != null && $srecto == null) {
                     foreach ($jobunits as $jobunit) {
                        if ($srecfrom == $jobunit->unitid) {
                           $recfrom = $jobunit->unitname;
                        }
                        $recto = "-";
                     }
                  } elseif ($srecfrom == null && $srecto != null) {
                     foreach ($jobunits as $jobunit) {
                        $recfrom = "-";
                        if ($srecto == $jobunit->unitid) {
                           $recto = $jobunit->unitname;
                        }
                     }
                  } else {
                     foreach ($jobunits as $jobunit) {
                        if ($srecfrom == $jobunit->unitid) {
                           $recfrom = $jobunit->unitname;
                        }
                        if ($srecto == $jobunit->unitid) {
                           $recto = $jobunit->unitname;
                        }
                     }
                  }
               } else {
                  if ($irecfrom == null && $irecto == null) {
                     $recfrom = "-";
                     $recto = "-";
                  } elseif ($irecfrom != null && $irecto == null) {
                     $recfrom = $irecfrom;
                     $recto = "-";
                  } elseif ($irecfrom == null && $irecto != null) {
                     $recfrom = "-";
                     $recto = $irecto;
                  } else {
                     $recfrom = $irecfrom;
                     $recto = $irecto;
                  }
               }
            }
         }
      } else {
         $typename = "-";
         $recfrom = "-";
         $recto = "-";
      }

      // เดือน
      switch ($rfrommonth) {
         case "01":
            $fmonth = "มกราคม";
            break;
         case "02":
            $fmonth = "กุมภาพันธ์";
            break;
         case "03":
            $fmonth = "มีนาคม";
            break;
         case "04":
            $fmonth = "เมษายน";
            break;
         case "05":
            $fmonth = "พฤษภาคม";
            break;
         case "06":
            $fmonth = "มิถุนายน";
            break;
         case "07":
            $fmonth = "กรกฎาคม";
            break;
         case "08":
            $fmonth = "สิงหาคม";
            break;
         case "09":
            $fmonth = "กันยายน";
            break;
         case "10":
            $fmonth = "ตุลาคม";
            break;
         case "11":
            $fmonth = "พฤศจิกายน";
            break;
         case "12":
            $fmonth = "ธันวาคม";
            break;
         default:
            $fmonth = "-";
      }

      switch ($rtomonth) {
         case "01":
            $tmonth = "มกราคม";
            break;
         case "02":
            $tmonth = "กุมภาพันธ์";
            break;
         case "03":
            $tmonth = "มีนาคม";
            break;
         case "04":
            $tmonth = "เมษายน";
            break;
         case "05":
            $tmonth = "พฤษภาคม";
            break;
         case "06":
            $tmonth = "มิถุนายน";
            break;
         case "07":
            $tmonth = "กรกฎาคม";
            break;
         case "08":
            $tmonth = "สิงหาคม";
            break;
         case "09":
            $tmonth = "กันยายน";
            break;
         case "10":
            $tmonth = "ตุลาคม";
            break;
         case "11":
            $tmonth = "พฤศจิกายน";
            break;
         case "12":
            $tmonth = "ธันวาคม";
            break;
         default:
            $tmonth = "-";
      }
      // ปี
      if ($rfromyear != null) {
         $fyear = $rfromyear + 543;
      } else {
         $fyear = "-";
      }

      if ($rtoyear != null) {
         $tyear = $rtoyear + 543;
      } else {
         $tyear = "-";
      }

      $searchLog = ' ชนิดหนังสือ : ' . $typename . ' จาก  : ' . $recfrom . ' ถึง  : ' . $recto . ' หัวเรื่อง  : ' . $rregtitle .
      ' เมื่อ  : เดือน ' . $fmonth . 'ปี ' . $fyear . ' ถึง  : เดือน ' . $tmonth . 'ปี ' . $tyear;

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin ค้นหาเอกสาร "ทะเบียนหนังสือรับ"' . $searchLog;
      } else {
         $log_activity->action = 'User ค้นหาเอกสาร "ทะเบียนหนังสือรับ"' . $searchLog;
      }

      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      // old input
      $input = $request->flash();
      return view('recdoc', compact(
         'searchrecs',
         'types',
         'recyears',
         'srecfrom',
         'srecto',
         'input'         
      ));
   }

   public function openfile(Request $request, $year, $recdoc)
   {
      $doc = Letterreg::where('regrecid', $recdoc)->first();
      $filename = $doc->regdoc;
      $path = 'files/' . $year . '/' . $filename;
      Log::info($path);
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เปิดไฟล์ ' . $filename;
      } else {
         $log_activity->action = 'User เปิดไฟล์ ' . $filename;
      }
      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      if (Storage::exists($path)) {
         return Storage::response($path);
      } else {
         // dd('File is Not Exists');
         abort(404);
      }
   }

   public function openfile2(Request $request, $year, $recdoc)
   {

      $doc = Letterreg::where('regrecid', $recdoc)->first();
      $filename = $doc->regdoc2;
      $path = 'files/' . $year . '/' . $filename;

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เปิดไฟล์ ' . $filename;
      } else {
         $log_activity->action = 'User เปิดไฟล์ ' . $filename;
      }
      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      if (Storage::exists($path)) {
         return Storage::response($path);
      } else {
         // dd('File is Not Exists');
         abort(404);
      }
   }
}
