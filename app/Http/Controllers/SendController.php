<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Lettersend;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
}
