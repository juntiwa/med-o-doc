<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

   public function letterreg()
   {
      return $this->belongsTo(Letterreg::class, 'typeid', 'regtype');
   }
   public function lettersend()
   {
      return $this->belongsTo(Lettersend::class, 'typeid', 'sendtype');
   }
   public function letterrec()
   {
      return $this->belongsTo(Letterrec::class, 'typeid', 'rectype');
   }
}
