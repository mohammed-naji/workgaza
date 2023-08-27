<?php

namespace App\Http\Controllers\Company;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Auth::id();
        // Auth::user();
        // $projects = Project::latest('id')
        // ->where('company_id', 1)
        // ->dd();

        // $projects = Project::latest('id')
        // ->where('company_id', 1)
        // ->toSql();

        $projects = Project::latest('id')
        ->where('company_id', Auth::id())
        ->paginate(10);

        return view('company.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::select('id', 'name')->get();
        $skills = Skill::select('id', 'name')->get();

        return view('company.projects.create', compact('categories', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
