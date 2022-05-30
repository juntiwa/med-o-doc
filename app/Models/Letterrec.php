<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Letterrec extends Model
{
   use HasFactory;

   public function thaidate()
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
      return $this->hasOne(Type::class, 'typeid', 'rectype');
   }

   //  from ส่งจากที่ไหน 1 เรื่องสามารถส่งได้หลายที่
   public function fromins()
   {
      return $this->hasMany(Jobunit::class, 'unitid', 'recfromid');
   }
   public function fromouts()
   {
      return $this->hasMany(Letterunit::class, 'unitid', 'recfromid');
   }

   // to ส่งถึงที่ไหน 1 เรื่องสามารถส่งถึงได้หลายที่
   public function toins()
   {
      return $this->hasMany(Jobunit::class, 'unitid', 'rectoid');
   }
   public function toouts()
   {
      return $this->hasMany(Letterunit::class, 'unitid', 'rectoid');
   }
   
}
