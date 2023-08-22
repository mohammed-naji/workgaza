<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    function category() {
        return $this->belongsTo(Category::class)->withDefault();
    }

    function company() {
        return $this->belongsTo(Company::class)->withDefault();
    }

    function skills() {
        return $this->belongsToMany(Skill::class);
    }

    function proposals() {
        return $this->hasMany(Proposal::class);
    }

    function user_project() {
        return $this->hasOne(UserProject::class)->withDefault();
    }
}
