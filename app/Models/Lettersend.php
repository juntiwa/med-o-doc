<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lettersend extends Model
{
   use HasFactory;

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
}
