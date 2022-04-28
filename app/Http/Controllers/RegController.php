<?php

namespace App\Http\Controllers;

use App\Models\Jobunit;
use App\Models\Letterreg;
use App\Models\Letterunit;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
   public function index(Request $request)
   {
      $regs = Letterreg::orderby('regdate', 'desc')->paginate(50);
      $types = Type::all();

      // for search input
      $regyears = Letterreg::select(DB::raw('YEAR(regdate) regyear'))->groupby('regyear')->get();
      $sregfrom = $request->get('sregfrom');
      $sregto = $request->get('sregto');

      foreach($regs as $reg){
         $filename = $reg->regdoc;
         $ext = substr(strrchr($filename, '.'), 1);
      // Log::info($ext);
      }
      
      return view('regdoc', compact('regs', 'types',  'regyears', 'sregfrom', 'sregto'));
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
      $sregto = $request->post('sregto');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option id="option" value="' . $list->unitid . '">' . $list->unitname . '</option>';
         if ($sregto == $list->unitid) {
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
         $response[] = array( "label" => $autocomplate->unitname);
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
   public function searchRegis(Request $request)
   {
      $regtype = $request->get('regtype');
      $sregfrom = $request->get('sregfrom');
      $iregfrom = $request->get('iregfrom');
      $sregto = $request->get('sregto');
      $iregto = $request->get('iregto');
      $regtitle = $request->get('regtitle');
      $frommonth = $request->get('frommonth');
      $tomonth = $request->get('tomonth');
      $fromyear = $request->get('fromyear');
      $toyear = $request->get('toyear');

      $units = Letterunit::all();

      foreach ($units as $unit) {
         $unitname = $unit->unitname;
         // Log::info($unitname);
         if ($unitname == $iregfrom) {
            $fuid = $unit->unitid;
            // Log::info("f" . $fuid);
         }
         if ($unitname == $iregto) {
            $tuid = $unit->unitid;
            // Log::info("t" . $tuid);
         }
      }

      $searchregs = Letterreg::orderby('regdate', 'desc');

      if ($regtype != '') {
         $searchregs  = $searchregs->where('regtype', $regtype);
      }

      if ($sregfrom != '') {
         $searchregs  = $searchregs->where('regfrom', $sregfrom);
      }

      if ($iregfrom != '') {        
         $searchregs  = $searchregs->where('regfrom', $fuid);
      }

      if ($sregto != '') {
         $searchregs  = $searchregs->where('regto', $sregto);
      }

      if ($iregto != '') {
         $searchregs  = $searchregs->where('regto', $tuid);
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
         'sregto',
         'input'
      ));
   }

   public function openfile($year,$type,$regdoc){
      $filename = explode('.', $regdoc)[0];
      $ext = substr(strrchr($regdoc, '.'), 1);
      Log::info($year);
      Log::info($regdoc);
      

      $file = ('files/'. $year.'/') . $filename .'.'. $type;
      Log::info($file);
      Log::info(response()->download($file));
      if (file_exists($file)) {
         return Storage::response($file);

         // return response()->download($file);
      } else {
         abort(404, 'File not found!');
      }
      
   }
}
