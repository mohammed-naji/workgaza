<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    function dashboard($lang = 'en') {
        App::setlocale($lang);
        return view('admin.dashboard');
    }
}
