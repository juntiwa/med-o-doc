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
      $frommonth = $request->get('frommonth');
      $tomonth = $request->get('tomonth');
      $fromyear = $request->get('fromyear');
      $toyear = $request->get('toyear');


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

      if ($frommonth != '' && $tomonth != '') {
         $searchsends  = $searchsends->whereBetween(DB::raw('MONTH(senddate)'), array($frommonth, $tomonth));
      }
      if ($fromyear != '' && $toyear != '') {
         $searchsends  = $searchsends->whereBetween(DB::raw('Year(senddate)'), array($fromyear, $toyear));
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
                  if ($irfrom == null && $irto == null) {
                     $sendfrom = "-";
                     $sendto = "-";
                  } elseif ($irfrom != null && $irto == null) {
                     $sendfrom = $irfrom;
                     $sendto = "-";
                  } elseif ($irfrom == null && $irto != null) {
                     $sendfrom = "-";
                     $sendto = $irto;
                  } else {
                     $sendfrom = $irfrom;
                     $sendto = $irto;
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
      if($fromyear != null){
         $fyear = $fromyear + 543;
      }else{
         $fyear = "-";
      }

      if($toyear != null){
         $tyear = $toyear + 543;
      }else{
         $tyear = "-";
      }

      return view('senddoc', compact(
         'searchsends',
         'types',
         'sendyears',

         'typename',
         'sendfrom',
         'sendto',
         'regtitle',
         'fmonth',
         'tmonth',
         'fyear',
         'tyear'
      ));
   }
}
