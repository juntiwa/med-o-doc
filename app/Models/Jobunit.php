<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobunit extends Model
{
    use HasFactory;

    public function document()
    {
        //jobunit belong to document
        return $this->belongsTo(Letterreg::class, 'unitid', 'regfrom');
    }

    public function description()
    {
        //jobunit belong to description
        return $this->belongsTo(Lettersend::class, 'unitid', 'sendtoid');
    }
}
