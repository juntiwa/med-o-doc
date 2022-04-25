<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Letterreg;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Input;
use SebastianBergmann\Environment\Console;

use function PHPSTORM_META\type;

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
   public function index()
   {
      $regs = Letterreg::orderby('regdate', 'desc')->paginate(50);
      $types = Type::all();

      // for search input
      $regyears = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();

      return view('regdoc', compact('regs', 'types',  'regyears'));
   }

   public function selectSearchfrom(Request $request)
   {
      $sregfrom = $request->post('sregfrom');
      $typeid = $request->post('typeid');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      
      echo ("<script type='text/javascript'> console.log($sregfrom);</script>");
      
      $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         $html .= '<option id="option" value="' . $list->unitid . '" >' . $list->unitname . '</option>';
         echo $list->unitid . '<br>';
      }
      echo $html;
   }
   public function selectSearchto(Request $request)
   {
      $typeid = $request->post('typeid');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $sregfrom = $request->get('sregfrom');
      function console_log($sregfrom, $with_script_tags = true)
      {
         $js_code = 'console.log(' . json_encode($sregfrom, JSON_HEX_TAG) .
         ');';
         if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
         }
         echo $js_code;
      }
      $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option id="option" value="' . $list->unitid . '">' . $list->unitname . '</option>';
         $html .= '<option value="' . $list->unitid . '" {{(old(' . $sregfrom . ')==' . $list->unitid . ')? "selected" : " "}}>' . $list->unitname . '</option>';

         // if (Input::old($sregfrom) == $list->unitid) {
         //    '<option id="option" value="' . $list->unitid . '" selected >' . $list->unitname . '</option>';
         // } else {
         //    '<option id="option" value="' . $list->unitid . '">' . $list->unitname . '</option>';
         // }  
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
   public function searchRegis(Request $request)
   {
      $regtype = $request->get('regtype');
      $sregfrom = $request->get('sregfrom');
      $iregfrom = $request->get('idfrom');
      $irfrom = $request->get('iregfrom');
      $sregto = $request->get('sregto');
      $iregto = $request->get('idto');
      $irto = $request->get('iregto');
      $regtitle = $request->get('regtitle');
      $frommonth = $request->get('frommonth');
      $tomonth = $request->get('tomonth');
      $fromyear = $request->get('fromyear');
      $toyear = $request->get('toyear');

      $searchregs = Letterreg::orderby('regdate', 'desc');

      if ($regtype != '') {
         $searchregs  = $searchregs->where('regtype', $regtype);
      }

      if ($sregfrom != '') {
         $searchregs  = $searchregs->where('regfrom', $sregfrom);
      }

      if ($iregfrom != '') {
         $searchregs  = $searchregs->where('regfrom', $iregfrom);
      }

      if ($sregto != '') {
         $searchregs  = $searchregs->where('regto', $sregto);
      }

      if ($iregto != '') {
         $searchregs  = $searchregs->where('regto', $iregto);
      }

      if ($regtitle != '') {
         $searchregs  = $searchregs->where('regtitle', 'LIKE', '%' . $regtitle . '%');
      }

      if ($frommonth != '' && $tomonth != '') {
         $searchregs  = $searchregs->whereBetween(DB::raw('MONTH(regdate)'), array($frommonth, $tomonth));
      }
      
      if ($fromyear != '' && $toyear != '') {
         $searchregs  = $searchregs->whereBetween(DB::raw('Year(regdate)'), array($fromyear, $toyear));
      }

      // Log::info($searchregs);
      $searchregs  = $searchregs->paginate(50);
      $types = Type::all();

      // for search input
      $regyears = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();

      // old input
      $input = $request->flash();
      return view('regdoc', compact(
         'searchregs',
         'types',
         'regyears',
         'sregfrom',
         'input'
      ));
   }
}
