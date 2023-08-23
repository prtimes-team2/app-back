<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class);
    }
    public function favorites(){
        return $this->hasMany(Favorite::class);
    }
    public function imageurls(){
        return $this->hasMany(Imageurl::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
