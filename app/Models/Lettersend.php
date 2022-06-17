<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Lettersend extends Model
{
    use HasFactory;

    protected $fillable = [
      'regrecid',
   ];

    public function thaidate()
    {
        return Carbon::parse($this->senddate)->thaidate();
    }

    public function thairecdate()
    {
        return Carbon::parse($this->recdate)->thaidate();
    }

    // สำหรับ regtitle
    public function letterregs()
    {
        return $this->hasMany(Letterreg::class, 'regrecid', 'regrecid');
    }

    //  type 1 เรื่อง มีได้ 1 ภาคเท่านั้น
    public function types()
    {
        return $this->hasOne(Type::class, 'typeid', 'sendtype');
    }

    //  from ส่งจากที่ไหน 1 เรื่องสามารถส่งได้หลายที่
    public function fromins()
    {
        return $this->hasMany(Jobunit::class, 'unitid', 'sendunitid');
    }

    public function fromouts()
    {
        return $this->hasMany(Letterunit::class, 'unitid', 'sendunitid');
    }

    // to ส่งถึงที่ไหน 1 เรื่องสามารถส่งถึงได้หลายที่
    public function toins()
    {
        return $this->hasMany(Jobunit::class, 'unitid', 'sendtoid');
    }

    public function toouts()
    {
        return $this->hasMany(Letterunit::class, 'unitid', 'sendtoid');
    }

    public function getSenddocUrlAttribute()
    {
        $year = substr($this->regdoc, 0, 4);

        return url("/open-files/{$year}/{$this->regrecid}");
    }

    public function getSenddoc2UrlAttribute()
    {
        $year = substr($this->regdoc2, 0, 4);

        return url("/open-files2/{$year}/{$this->regrecid}");
    }

    // description
    // to ส่งถึงที่ไหน 1 เรื่องสามารถส่งถึงได้หลายที่
    public function destoins()
    {
        return $this->hasMany(Jobunit::class, 'unitid', 'sendtoid');
    }

    public function destoouts()
    {
        return $this->hasMany(Letterunit::class, 'unitid', 'sendtoid');
    }

    public function thaidateregdate()
    {
        return Carbon::parse($this->regdate)->thaidate();
    }

    public function thaidatesenddate()
    {
        return Carbon::parse($this->senddate)->thaidate();
    }

    public function thaidaterecdate()
    {
        return Carbon::parse($this->recdate)->thaidate();
    }
}
