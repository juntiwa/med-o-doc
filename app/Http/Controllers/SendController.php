<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\Jobunit;
use App\Models\Letterreg;
use App\Models\Lettersend;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class SendController extends Controller
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
      $sends = Lettersend::join('letterregs', 'lettersends.regrecid', '=', 'letterregs.regrecid')
         ->orderby('senddate', 'desc')->paginate(50);
      $types = Type::all();

      // for search input
      $sendyears = Lettersend::select(DB::raw('YEAR(senddate) sendyear'))->groupby(DB::raw('YEAR(senddate)'))->get();
      $ssendfrom = $request->get('ssendfrom');
      $ssendto = $request->get('ssendto');

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เข้าสู่หน้า "ทะเบียนหนังสือส่ง"';
      } else {
         $log_activity->action = 'User เข้าสู่หน้า "ทะเบียนหนังสือส่ง"';
      }

      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      return view('senddoc', compact('sends', 'types', 'sendyears', 'ssendfrom', 'ssendto'));
   }

   public function selectSearchfrom(Request $request)
   {
      $typeid = $request->post('typeid');
      $ssendfrom = $request->post('ssendfrom');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option value="' . $list->unitid . '">' . $list->unitname . '</option>';
         if ($ssendfrom == $list->unitid) {
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
      $ssendto = $request->post('ssendto');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option value="' . $list->unitid . '">' . $list->unitname . '</option>';
         if ($ssendto == $list->unitid) {
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
   public function searchSend(Request $request)
   {
      $sendtype = $request->get('sendtype');
      $ssendfrom = $request->get('ssendfrom');
      $isendfrom = $request->get('isendfrom');
      $ssendto = $request->get('ssendto');
      $isendto = $request->get('isendto');
      $sregtitle = $request->get('sregtitle');
      $sfrommonth = $request->get('sfrommonth');
      $stomonth = $request->get('stomonth');
      $sfromyear = $request->get('sfromyear');
      $stoyear = $request->get('stoyear');

      $units = Letterunit::all();

      foreach ($units as $unit) {
         $unitname = $unit->unitname;
         // Log::info($unitname);
         if (stripos($unitname, $isendfrom) !== FALSE) {
            $fuid = $unit->unitid;
            // Log::info("f" . $fuid);
         }
         if (stripos($unitname, $isendto) !== FALSE) {
            $tuid = $unit->unitid;
            // Log::info("t" . $tuid);
         }
      }

      $searchsends = Lettersend::join('letterregs', 'lettersends.regrecid', '=', 'letterregs.regrecid')
         ->orderby('senddate', 'desc');

      if ($sendtype != '') {
         $searchsends  = $searchsends->where('sendtype', $sendtype);
      }

      if ($ssendfrom != '') {
         $searchsends  = $searchsends->where('sendunitid', $ssendfrom);
      }

      if ($isendfrom != '') {
         $searchsends  = $searchsends->where('sendunitid', $fuid);
      }

      if ($ssendto != '') {
         $searchsends  = $searchsends->where('sendtoid', $ssendto);
      }

      if ($isendto != '') {
         $searchsends  = $searchsends->where('sendtoid', $tuid);
      }

      if ($sregtitle != '') {
         $searchsends  = $searchsends->where('regtitle', 'LIKE', '%' . $sregtitle . '%');
      }

      if ($sfrommonth != '' && $stomonth != '') {
         $searchsends  = $searchsends->whereBetween(DB::raw('MONTH(senddate)'), array($sfrommonth, $stomonth));
      }

      if ($sfromyear != '' && $stoyear != '') {
         $searchsends  = $searchsends->whereBetween(DB::raw('Year(senddate)'), array($sfromyear, $stoyear));
      }

      // Log::info($regs);
      $searchsends  = $searchsends->paginate(50);
      $types = Type::all();

      // for search input
      $sendyears = Lettersend::select(DB::raw('YEAR(senddate) sendyear'))->groupby(DB::raw('YEAR(senddate)'))->get();

      // แสดงข้อมูลที่ค้นหา บนตาราง
      $jobunits = Jobunit::all();
      $letterunits = Letterunit::all();

      // ชนิดหนังสือ
      if ($sendtype != null) {
         foreach ($types as $type) {
            if ($sendtype == $type->typeid) {
               $typename = $type->typename;
               if ($sendtype == 0) {
                  if ($ssendfrom == null && $ssendto == null) {
                     $sendfrom = "-";
                     $sendto = "-";
                  } elseif ($ssendfrom != null && $ssendto == null) {
                     foreach ($jobunits as $jobunit) {
                        if ($ssendfrom == $jobunit->unitid) {
                           $sendfrom = $jobunit->unitname;
                        }
                        $sendto = "-";
                     }
                  } elseif ($ssendfrom == null && $ssendto != null) {
                     foreach ($jobunits as $jobunit) {
                        $sendfrom = "-";
                        if ($ssendto == $jobunit->unitid) {
                           $sendto = $jobunit->unitname;
                        }
                     }
                  } else {
                     foreach ($jobunits as $jobunit) {
                        if ($ssendfrom == $jobunit->unitid) {
                           $sendfrom = $jobunit->unitname;
                        }
                        if ($ssendto == $jobunit->unitid) {
                           $sendto = $jobunit->unitname;
                        }
                     }
                  }
               } else {
                  if ($isendfrom == null && $isendto == null) {
                     $sendfrom = "-";
                     $sendto = "-";
                  } elseif ($isendfrom != null && $isendto == null) {
                     $sendfrom = $isendfrom;
                     $sendto = "-";
                  } elseif ($isendfrom == null && $isendto != null) {
                     $sendfrom = "-";
                     $sendto = $isendto;
                  } else {
                     $sendfrom = $isendfrom;
                     $sendto = $isendto;
                  }
               }
            }
         }
      } else {
         $typename = "-";
         $sendfrom = "-";
         $sendto = "-";
      }


      // เดือน

      switch ($sfrommonth) {
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

      switch ($stomonth) {
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
      if ($sfromyear != null) {
         $fyear = $sfromyear + 543;
      } else {
         $fyear = "-";
      }

      if ($stoyear != null) {
         $tyear = $stoyear + 543;
      } else {
         $tyear = "-";
      }

      $searchLog = ' ชนิดหนังสือ : ' . $typename . ' จาก  : ' . $sendfrom . ' ถึง  : ' . $sendto . ' หัวเรื่อง  : ' . $sregtitle .
      ' เมื่อ  : เดือน ' . $fmonth .'ปี ' . $fyear . ' ถึง  : เดือน ' . $tmonth .'ปี '. $tyear;
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin ค้นหาเอกสาร "ทะเบียนหนังสือส่ง"' . $searchLog;
      } else {
         $log_activity->action = 'User ค้นหาเอกสาร "ทะเบียนหนังสือส่ง"' . $searchLog;
      }

      $dt = Carbon::now();
      $log_activity->date_time = date("d-m-Y H:i:s");
      $log_activity->save();

      // old input
      $input = $request->flash();
      return view('senddoc', compact(
         'searchsends',
         'types',
         'sendyears',
         'ssendfrom',
         'ssendto',
         'input'
      ));
   }
   public function openfile(Request $request, $year, $senddoc)
   {
      $doc = Letterreg::where('regrecid', $senddoc)->first();
      $filename = $doc->regdoc;
      $path = 'files/' . $year . '/' . $filename;
      // Log::info($path);
      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เปิดไฟล์ ' . $senddoc . '.' . $filename;
      } else {
         $log_activity->action = 'User เปิดไฟล์ ' . $senddoc . '.' . $filename;
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

   public function openfile2(Request $request, $year, $senddoc)
   {

      $doc = Letterreg::where('regrecid', $senddoc)->first();
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
