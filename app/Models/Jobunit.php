<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobunit extends Model
{
   use HasFactory;
   protected $fillable = [
      'unitid',
      'unitname',
      'unitlevel',
      'unitengname',
      'shotunitname',
      'datein',
      'userin',
      'status',
      'updated_at',
      'created_at'
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
