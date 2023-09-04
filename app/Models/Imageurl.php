<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imageurl extends Model
{
    use HasFactory;

    public function reports(){
        return $this->belongsTo(Report::class, 'report_id');
    }
}
