<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function favourites(){
        return $this->belongsTo(User::class, 'favourite_id');
    }
}
