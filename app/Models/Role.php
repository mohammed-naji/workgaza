<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['permissions'];

    function admins() {
        return $this->hasMany(Admin::class);
    }

    function permissions() {
        return $this->belongsToMany(Permission::class);
    }
}
