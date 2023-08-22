<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    function projects() {
        return $this->belongsToMany(Project::class);
    }

    function users() {
        return $this->belongsToMany(User::class, 'user_skill');
    }
}
