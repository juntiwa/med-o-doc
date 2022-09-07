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
            /* if ($data['Status'] == 'Active') {
                if (Member::where('org_id', $sapid)->exists()) {
                    $result = ['Status' => $data['Status'], 'Exist' => 'Yes', 'AccountName' => $data['AccountName'].' มีอยู่แล้ว'];
                } else {
                    $result = ['Status' => $data['Status'], 'Exist' => 'No', 'AccountName' => $data['AccountName']];
                }
            } else {
                $result = ['Status' => $data['Status'], 'AccountName' => $data['AccountName'].' ไม่ได้เป็นพนักงาน'];
            } */

            $headers = ['app' => config('app.HAN_API_SERVICE_SECRET'), 'token' => config('app.HAN_API_SERVICE_TOKEN')];
            $options = ['timeout' => 8.0, 'verify' => false];
//        $checkaccHannah = 'https://simed.mahidol.ac.th/hannah/user';
            $url = config('app.HAN_API_SERVICE_ADD_USER_URL');
            $responseHannah = Http::withHeaders($headers)->post($url, ['login' => $data['AccountName']]);
            // $responseHannah = Http::post($checkaccHannah,[$data['AccountName'] => $checkaccHannah['login']]);
            $dataHannah = $responseHannah->json();

            if ($dataHannah['division_name'] == 'ภ.อายุรศาสตร์') {
                if ($data['Status'] == 'Active') {
                    if (Member::where('org_id', $sapid)->exists()) {
                        $result = ['Status' => $data['Status'], 'Exist' => 'Yes', 'AccountName' => $dataHannah['full_name'] . ' มีอยู่แล้ว'];
                    } else {
                        $result = ['Status' => $data['Status'], 'Exist' => 'No', 'AccountName' => $dataHannah['full_name']];
                    }
                } else {
                    $result = ['Status' => $data['Status'], 'AccountName' => $dataHannah['full_name'] . ' ไม่ได้เป็นพนักงาน'];
                }
            }else{
                $result = ['Status' => 'Null', 'AccountName' => $dataHannah['full_name'] . ' ไม่เป็นพนักงานของภาควิชาอายุรศาสตร์'];
            }

//        return $dataHannah;
//        return $data;
        } else {
            $result = ['Status' => 'Null', 'AccountName' => 'ไม่มีข้อมูลพนักงาน'];
        }

        return $result;
    }
}
