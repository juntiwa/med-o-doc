<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Letterrec;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecController extends Controller
{
   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index()
   {
      $recs = Letterrec::join('letterregs', 'letterrecs.regrecid', '=', 'letterregs.regrecid')
         ->orderby('letterrecs.recdate', 'desc')->paginate(50);
      $types = Type::all();


      // for search input
      $recyears = Letterrec::select(DB::raw('YEAR(recdate) recyear'))->groupby(DB::raw('YEAR(recdate)'))->get();

      return view('recdoc', compact('recs', 'types', 'recyears'));
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
      $irecfrom = $request->get('idfrom');
      $irfrom = $request->get('irecfrom');
      $srecto = $request->get('srecto');
      $irecto = $request->get('idto');
      $irto = $request->get('irecto');
      $regtitle = $request->get('regtitle');
      $rfrommonth = $request->get('rfrommonth');
      $rtomonth = $request->get('rtomonth');
      $rfromyear = $request->get('rfromyear');
      $rtoyear = $request->get('rtoyear');

      $searchrecs = Letterrec::join('letterregs', 'letterrecs.regrecid', '=', 'letterregs.regrecid')->orderby('letterrecs.recdate', 'desc');

      if ($rectype != '') {
         $searchrecs  = $searchrecs->where('rectype', $rectype);
      }

      if ($srecfrom != '') {
         $searchrecs  = $searchrecs->where('recfromid', $srecfrom);
      }

      if ($irecfrom != '') {
         $searchrecs  = $searchrecs->where('recfromid', $irecfrom);
      }

      if ($srecto != '') {
         $searchrecs  = $searchrecs->where('rectoid', $srecto);
      }

      if ($irecto != '') {
         $searchrecs  = $searchrecs->where('rectoid', $irecto);
      }

      if ($regtitle != '') {
         $searchrecs  = $searchrecs->where('regtitle', 'LIKE', '%' . $regtitle . '%');
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

      // old input
      $input = $request->flash();
      return view('recdoc', compact(
         'searchrecs',
         'types',
         'recyears',
         'input'         
      ));
   }
}
