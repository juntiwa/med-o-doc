<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Sanctum\HasApiTokens;

class Letterreg extends Model
{
   use HasApiTokens, HasFactory, Notifiable;

   /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
   protected $fillable = [
      'regtitle',
      'regrecid'
   ];

   public function thaidateregdate(){
      return Carbon::parse($this->regdate)->thaidate();
   }

   public function thaidatesenddate(){
      return Carbon::parse($this->senddate)->thaidate();
   }

   public function thaidaterecdate(){
      return Carbon::parse($this->recdate)->thaidate();
   }

   //  type 1 เรื่อง มีได้ 1 ภาคเท่านั้น
    public function types(){
      return $this->hasOne(Type::class, 'typeid', 'regtype');
    }

   //  from ส่งจากที่ไหน 1 เรื่องสามารถส่งได้หลายที่
   public function fromins()
   {
      return $this->hasMany(Jobunit::class, 'unitid', 'regfrom');
   }
   public function fromouts()
   {
      return $this->hasMany(Letterunit::class, 'unitid', 'regfrom');
   }

   // to ส่งถึงที่ไหน 1 เรื่องสามารถส่งถึงได้หลายที่
   public function toins()
   {
      return $this->hasMany(Jobunit::class, 'unitid', 'regto');
   }
   public function toouts()
   {
      return $this->hasMany(Letterunit::class, 'unitid', 'regto');
   }

   // send for regtitle
   public function lettersends()
   {
      return $this->belongsTo(Lettersend::class, 'regrecid', 'regrecid');
   }

   // rec for regtitle
   public function letterrecs()
   {
      return $this->belongsTo(Letterrec::class, 'regrecid', 'regrecid');
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

   public function getTitleAttribute()
   {
      $regrecid =  $this->regrecid;
      return url("description-document/{$regrecid}");
   }

//  from ส่งจากที่ไหน 1 เรื่องสามารถส่งได้หลายที่
   public function desfromins()
   {
      return $this->hasMany(Jobunit::class, 'unitid', 'regfrom');
   }
   public function desfromouts()
   {
      return $this->hasMany(Letterunit::class, 'unitid', 'regfrom');
   }
   
}
