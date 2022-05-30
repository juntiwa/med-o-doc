<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letterunit extends Model
{
   use HasFactory;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'unitname',
   ];

   // reg
   public function letterregfrom()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'regfrom');
   }

   public function letterregto()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'regto');
   }

   // send
   public function lettersendfrom()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'sendunitid');
   }

   public function lettersendto()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'sendtoid');
   }

   // rec
   public function letterrecfrom()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'recfromid');
   }

   public function letterrecto()
   {
      return $this->belongsTo(Letterreg::class, 'unitid', 'rectoid');
   }
}
