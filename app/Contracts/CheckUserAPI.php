<?php

namespace App\Contracts;

interface CheckUserAPI
{
    public function checkuser($sapid);

    public function checkexist($sapid);
}
