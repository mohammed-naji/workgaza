<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    function employees() {
        return $this->hasMany(User::class);
    }

    function projects() {
        return $this->hasMany(Project::class);
    }

    function reviews() {
        return $this->hasMany(Review::class);
    }

    function my_reviews() {
        return $this->hasMany(CompanyReview::class);
    }

    function payments() {
        return $this->hasMany(Payment::class);
    }
}
