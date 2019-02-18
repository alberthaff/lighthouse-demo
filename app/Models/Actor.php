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
}
