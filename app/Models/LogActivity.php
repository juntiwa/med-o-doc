<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LogActivity extends Model
{
    use HasFactory;

    public function getThaiActivityDateAttribute()
    {
        return Carbon::parse($this->date_time)->thaidate('j F Y H:i:s');
    }
}
