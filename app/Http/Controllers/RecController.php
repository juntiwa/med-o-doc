<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Letterrec;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
         if ($unitname == $irecfrom) {
            $fuid = $unit->unitid;
            // Log::info("f" . $fuid);
         }
         if ($unitname == $irecto) {
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

   public function openfile($year, $type, $recdoc)
   {
      $path = 'files/' . $year . '/' . $recdoc . '.' . $type;
      if (Storage::exists($path)) {
         return Storage::response($path);
      } else {
         // dd('File is Not Exists');
         return view('errors.404');
      }
   }
}
