<?php

namespace App\APIs;

use App\Contracts\CheckUserAPI;
use Illuminate\Support\Facades\Http;

class CheckAccountAPI implements CheckUserAPI
{
    public function checkuser($sapid)
    {
        $checkacc = 'https://si-eservice3.si.mahidol.ac.th/selfservice/API/checkSamAcc';
        $response = Http::post($checkacc, ['employeeID' => $sapid]);

        $data = json_decode($response->getBody(), true);

        return $data;
    }
}
