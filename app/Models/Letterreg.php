<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Letterreg extends Model
{
    use HasFactory;

    public function type()
    {
        // document has one type
        return $this->hasOne(Type::class, 'typeid', 'regtype');
    }

    public function jobunit()
    {
        // document has one send from unit inner
        return $this->hasOne(Jobunit::class, 'unitid', 'regfrom');
    }

    public function letterunit()
    {
        // document has one send from unit outter
        return $this->hasOne(Letterunit::class, 'unitid', 'regfrom');
    }

    public function getThaiRegisterDateAttribute()
    {
        return Carbon::parse($this->regdate)->thaidate();
    }

    public function getRegdocUrlAttribute()
    {
        $year = substr($this->regdoc, 0, 4);

        return url("/open-files/{$year}/{$this->regrecid}");
    }

    public function getRegdoc2UrlAttribute()
    {
        $year = substr($this->regdoc2, 0, 4);

        return url("/open-files2/{$year}/{$this->regrecid}");
    }
    
    public function getTitleDescriptionAttribute()
    {
        $idTitle = $this->regrecid;
        return url("description/{$idTitle}");
    }
}
