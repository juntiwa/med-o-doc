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
      $frommonth = $request->get('frommonth');
      $tomonth = $request->get('tomonth');
      $fromyear = $request->get('fromyear');
      $toyear = $request->get('toyear');


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

      if ($frommonth != '' && $tomonth != '') {
         $searchrecs  = $searchrecs->whereBetween(DB::raw('MONTH(letterrecs.recdate)'), array($frommonth, $tomonth));
      }
      if ($fromyear != '' && $toyear != '') {
         $searchrecs  = $searchrecs->whereBetween(DB::raw('Year(letterrecs.recdate)'), array($fromyear, $toyear));
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
                  if ($irfrom == null && $irto == null) {
                     $recfrom = "-";
                     $recto = "-";
                  } elseif ($irfrom != null && $irto == null) {
                     $recfrom = $irfrom;
                     $recto = "-";
                  } elseif ($irfrom == null && $irto != null) {
                     $recfrom = "-";
                     $recto = $irto;
                  } else {
                     $recfrom = $irfrom;
                     $recto = $irto;
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

      return view('recdoc', compact(
         'searchrecs',
         'types',
         'recyears',

         'typename',
         'recfrom',
         'recto',
         'regtitle',
         'fmonth',
         'tmonth',
         'fyear',
         'tyear'
      ));
   }
}
