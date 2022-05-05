<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class activityLog extends Model
{
    use HasFactory;

   public function thaidate()
   {
      return Carbon::parse($this->date_time)->thaidate('j F Y เวลา H:i:s');
   }
}
