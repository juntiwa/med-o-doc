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

   public function selectSearch(Request $request)
   {
      $typeid = $request->post('typeid');
      $unit = Jobunit::where('unitlevel', $typeid)->orderBy('unitname', 'asc')->get();
      $sregfrom = $request->get('sregfrom');
      $html = '<option id="option" value="">--เลือกหน่วยงานที่ต้องการ--</option>';
      foreach ($unit as $list) {
         // $html .= '<option id="option" value="' . $list->unitid . '">' . $list->unitname . '</option>';
         $html .= '<option value="' . $list->unitid . '" {{(old('.$sregfrom . ')==' . $list->unitid . ')? "selected" : " "}}>' . $list->unitname . '</option>';

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
      // Log::info(url()->current());

      // แสดงข้อมูลที่ค้นหา บนตาราง
      $jobunits = Jobunit::all();
      $letterunits = Letterunit::all();
      // ชนิดหนังสือ
      if ($regtype != null) {
         foreach ($types as $type) {
            if ($regtype == $type->typeid) {
               $typename = $type->typename;
               if($regtype == 0){
                  if ($sregfrom == null && $sregto == null) {
                     $regfrom = "-";
                     $regto = "-";
                  } elseif ($sregfrom != null && $sregto == null) {
                     foreach ($jobunits as $jobunit) {
                        if ($sregfrom == $jobunit->unitid) {
                           $regfrom = $jobunit->unitname;
                        }
                        $regto = "-";
                     }
                  } elseif ($sregfrom == null && $sregto != null) {
                     foreach ($jobunits as $jobunit) {
                        $regfrom = "-";
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
               }else{
                  if ($irfrom == null && $irto == null) {
                     $regfrom = "-";
                     $regto = "-";
                  } elseif ($irfrom != null && $irto == null) {
                     $regfrom = $irfrom;
                     $regto = "-";
                  } elseif ($irfrom == null && $irto != null) {
                     $regfrom = "-";
                     $regto = $irto;
                  } else{
                     $regfrom = $irfrom;
                     $regto = $irto ;
                  }
               }
               
            }
         }
      } else {
         $typename = "-";
         $regfrom = "-";
         $regto = "-";
      }

      // เดือน

      switch ($frommonth) {
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

      switch ($tomonth) {
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
      if ($fromyear != null) {
         $fyear = $fromyear + 543;
      } else {
         $fyear = "-";
      }

      if ($toyear != null) {
         $tyear = $toyear + 543;
      } else {
         $tyear = "-";
      }

      // old input
      $input = $request->flash();
      return view('regdoc', compact(
         'searchregs',
         'types',
         'regyears',
         
         'typename',
         'regfrom',
         'regto',
         'regtitle',
         'fmonth',
         'tmonth',
         'fyear',
         'tyear',
         'input'
      ));
   }
}
