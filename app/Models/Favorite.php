<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }
    public function reports(){
        return $this->belongsTo(Report::class, 'report_id');
    }
}
