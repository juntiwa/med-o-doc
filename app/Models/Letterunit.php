<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letterunit extends Model
{
    use HasFactory;

    public function document()
    {
        //letterunit belong to document
        return $this->belongsTo(Letterreg::class, 'unitid', 'regfrom');
    }
    public function description()
    {
        //letterunit belong to description
        return $this->belongsTo(Lettersend::class, 'unitid', 'sendtoid');
    }
}
