<?php

namespace App\APIs;

use App\Contracts\CheckUserAPI;
use App\Models\Member;
use Illuminate\Support\Facades\Http;

class CheckAccountAPI implements CheckUserAPI
{
    public function checkuser($sapid)
    {
        $checkacc = 'https://si-eservice3.si.mahidol.ac.th/selfservice/API/checkSamAcc';
        $response = Http::post($checkacc, ['employeeID' => $sapid]);

        $data = $response->json();

        $count = count($data);
        if ($count === 2) {
            $result = ['Status' => 'Null', 'AccountName' => 'ไม่มีข้อมูลพนักงาน'];
        } elseif ($count === 3) {
            if ($data['Status'] == 'Active') {
                if (Member::where('org_id', $sapid)->exists()) {
                    $result = ['Status' => $data['Status'], 'Exist' => 'Yes', 'AccountName' => $data['AccountName'].' มีอยู่แล้ว'];
                } else {
                    $result = ['Status' => $data['Status'], 'Exist' => 'No', 'AccountName' => $data['AccountName']];
                }
            } else {
                $result = ['Status' => $data['Status'], 'AccountName' => $data['AccountName'].' ไม่ได้เป็นพนักงาน'];
            }
        }else{
            $result = ['Status' => 'Null', 'AccountName' => 'ไม่มีข้อมูลพนักงาน'];

        }

        return $result;
    }
}
