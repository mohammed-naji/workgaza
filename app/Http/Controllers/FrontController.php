<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Project;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    function index() {
        $categories = Category::with('projects')->whereHas('projects')->latest('id')->get();
        $latest_projects = Project::with('company')->latest('id')->limit(5)->get();

        return view('front.index', compact('categories', 'latest_projects'));
    }

    function projects($category = null) {
        if($category) {
            $category = Category::with('projects')->findOrFail($category);
            $projects = $category->projects()->paginate(10);
        }else {
            $projects = Project::latest('id')->paginate(10);
        }

        dd($projects);

        return view('front.projects_list', compact('projects'));
    }
}
