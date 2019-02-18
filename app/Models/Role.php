<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        "actor_id",
        "movie_id",
        "character"
    ];

    public function actor() {
        return $this->belongsTo(Actor::class);
    }

    public function movie() {
        return $this->belongsTo(Movie::class);
    }
}
