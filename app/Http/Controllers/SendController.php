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
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $sends = Lettersend::join('letterregs', 'lettersends.regrecid', '=', 'letterregs.regrecid')
         ->orderby('senddate', 'desc')->paginate(50);
      $types = Type::all();


      // for search input
      $sendyears = Lettersend::select(DB::raw('YEAR(senddate) sendyear'))->groupby(DB::raw('YEAR(senddate)'))->get();

      return view('senddoc', compact('sends', 'types', 'sendyears'));
   }

   public function selectSearch(Request $request)
   {
      $typeid = $request->post('typeid');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         $html .= '<option value="' . $list->unitid . '">' . $list->unitname . '</option>';
         echo $list->unitid . '<br>';
      }
      echo $html;
   }

   public function autocompleteSearch(Request $request)
   {
      $search = $request->search;
      if ($search == '') {
         $units = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->limit(20)->get();
      } else {
         $units = Letterunit::orderby('unitname', 'asc')->select('unitid', 'unitname')->where('unitname', 'like', '%' . $search . '%')->limit(20)->get();
      }
      $response = array();
      foreach ($units as $unit) {
         $response[] = array("value" => $unit->unitid, "label" => $unit->unitname);
      }
      return response()->json($response);
   }

   public function searchSend(Request $request)
   {
      $sendtype = $request->get('sendtype');
      $ssendfrom = $request->get('ssendfrom');
      $isendfrom = $request->get('idfrom');
      $irfrom = $request->get('isendfrom');
      $ssendto = $request->get('ssendto');
      $isendto = $request->get('idto');
      $irto = $request->get('isendto');
      $regtitle = $request->get('regtitle');
      $sfrommonth = $request->get('sfrommonth');
      $stomonth = $request->get('stomonth');
      $sfromyear = $request->get('sfromyear');
      $stoyear = $request->get('stoyear');

      $searchsends = Lettersend::join('letterregs', 'lettersends.regrecid', '=', 'letterregs.regrecid')
         ->orderby('senddate', 'desc');

      if ($sendtype != '') {
         $searchsends  = $searchsends->where('sendtype', $sendtype);
      }

      if ($ssendfrom != '') {
         $searchsends  = $searchsends->where('sendunitid', $ssendfrom);
      }

      if ($isendfrom != '') {
         $searchsends  = $searchsends->where('sendunitid', $isendfrom);
      }

      if ($ssendto != '') {
         $searchsends  = $searchsends->where('sendtoid', $ssendto);
      }

      if ($isendto != '') {
         $searchsends  = $searchsends->where('sendtoid', $isendto);
      }

      if ($regtitle != '') {
         $searchsends  = $searchsends->where('regtitle', 'LIKE', '%' . $regtitle . '%');
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
         'input'
      ));
   }
}
