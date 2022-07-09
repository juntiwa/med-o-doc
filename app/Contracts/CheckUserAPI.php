<?php

namespace App\Contracts;

use Illuminate\Http\Request;

interface CheckUserAPI
{
    public function checkuser($sapid);
    public function checkexist($sapid);
}
