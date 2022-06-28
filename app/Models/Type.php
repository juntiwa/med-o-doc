<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function doucument()
    {
        // type belong to document
        return $this->belongsTo(Letterreg::class, 'typeid', 'regtype');
    }
}
