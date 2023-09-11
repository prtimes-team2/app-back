<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
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

    public static function getLatest($address)
    {
        return self::query()
            ->where('address', $address)
            ->orderBy('created_at', 'desc')
            ->with(['users', 'imageurls', 'tags']) // eager loading
            ->limit(20)
            ->get();
    }
}
