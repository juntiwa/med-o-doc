<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class LogActivity extends Model
{
    use HasFactory;

   /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
      'username',
      'full_name',
      'office_name',
      'action',
      'type',
      'url',
      'method',
      'user_agent',
      'date_time',
    ];

    public function getThaiActivityDateAttribute()
    {
        return Carbon::parse($this->date_time)->thaidate('j F Y H:i:s');
    }
}
