<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actor extends Model
{
    protected $fillable = [
        'name',
        'tmdb_id',
        'profile'
    ];

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function getProfileAttribute() {
        if(is_null($this->attributes["profile"])){
            return null;
        }
        return config('tmdb.image_prefix').'w500'.$this->attributes["profile"];
    }
}
