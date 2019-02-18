<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'tmdb_id',
        'imdb_id',
        'title',
        'status',
        'release_date',
        'overview',
        'runtime',
        'poster'
    ];

    public function roles() {
        return $this->hasMany(Role::class);
    }

    public function getPosterAttribute() {
        if(is_null($this->attributes["poster"])){
            return null;
        }
        return config('tmdb.image_prefix').'w500'.$this->attributes["poster"];
    }
}
