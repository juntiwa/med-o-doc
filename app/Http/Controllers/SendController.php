<?php

namespace App\Http\Controllers;

use App\Models\activityLog;
use App\Models\Jobunit;
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
      $log_activity->date_time = $dt->toDayDateTimeString();
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
         if ($unitname == $isendfrom) {
            $fuid = $unit->unitid;
            // Log::info("f" . $fuid);
         }
         if ($unitname == $isendto) {
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

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin ค้นหาเอกสาร "ทะเบียนหนังสือส่ง"';
      } else {
         $log_activity->action = 'User ค้นหาเอกสาร "ทะเบียนหนังสือส่ง"';
      }

      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
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
   public function openfile(Request $request, $year, $type, $senddoc)
   {
      $path = 'files/' . $year . '/' . $senddoc . '.' . $type;

      $log_activity = new activityLog;
      $log_activity->username = Auth::user()->username;
      $log_activity->program_name = 'med_edu';
      $log_activity->url = URL::current();
      $log_activity->method = $request->method();
      $log_activity->user_agent = $request->header('user-agent');
      if (Auth::user()->is_admin == "1") {
         $log_activity->action = 'Admin เปิดไฟล์ ' . $senddoc . '.' . $type;
      } else {
         $log_activity->action = 'User เปิดไฟล์ ' . $senddoc . '.' . $type;
      }

      $dt = Carbon::now();
      $log_activity->date_time = $dt->toDayDateTimeString();
      $log_activity->save();

      if (Storage::exists($path)) {
         return Storage::response($path);
      } else {
         // dd('File is Not Exists');
         return view('errors.404');
      }
   }
}
