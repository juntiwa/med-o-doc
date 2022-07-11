<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lettersend extends Model
{
    use HasFactory;

    public function getThaiSendDateAttribute()
    {
        return Carbon::parse($this->senddate)->thaidate();
    }

    public function getThaiRecDateAttribute()
    {
        return Carbon::parse($this->recdate)->thaidate();
    }

    public function jobunit()
    {
        // document has one send from unit inner
        return $this->hasMany(Jobunit::class, 'unitid', 'sendtoid');
    }

    public function letterunit()
    {
        // document has one send from unit outter
        return $this->hasMany(Letterunit::class, 'unitid', 'sendtoid');
    }
}
