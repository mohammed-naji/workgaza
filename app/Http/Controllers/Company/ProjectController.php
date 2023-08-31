<?php

namespace App\Http\Controllers\Company;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Auth::id();
        // Auth::user();
        // $projects = Project::latest('id')
        // ->where('company_id', 1)
        // ->dd();

        // $projects = Project::latest('id')
        // ->where('company_id', 1)
        // ->toSql();

        $projects = Project::with('category', 'skills')->latest('id')
        ->where('company_id', 1)
        ->paginate(2);

        if($request->ajax()) {
            return view('company.projects._table', compact('projects'))->render();
        }

        $categories = Category::select('id', 'name')->get();
        $skills = Skill::select('id', 'name')->get();

        return view('company.projects.index', compact('projects', 'categories', 'skills'));
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
        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'content' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category_id' => 'required',
            'skills' => 'required',
        ]);

        $img_name = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'),$img_name);

        $data = $request->except('_token', 'image', 'skills');
        $data['image'] = $img_name;
        $data['company_id'] = 1;

        // dd($data);
        $project = Project::create($data);

        // dd($project, $request->skills);
        // $project->skills()->attach($request->skills);
        // $project->skills()->detach($request->skills);
        $project->skills()->sync($request->skills);


        $projects = Project::with('category', 'skills')->latest('id')
        ->where('company_id', 1)
        ->paginate(2);

        return view('company.projects._table', compact('projects'))->render();
        // return redirect()
        // ->route('company.projects.index')
        // ->with('msg', 'Project added successfully')
        // ->with('type', 'success');
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
    public function edit(Project $project)
    {
        $categories = Category::select('id', 'name')->get();
        $skills = Skill::select('id', 'name')->get();

        return view('company.projects.edit', compact('project', 'categories', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'content' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category_id' => 'required',
            'skills' => 'required',
        ]);

        $data = $request->except('_token', 'image', 'skills');

        if($request->hasFile('image')) {
            File::delete(public_path('images/',$project->image));
            $img_name = rand().time().$request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('images'),$img_name);
            $data['image'] = $img_name;
        }

        // dd($data);
        $project->update($data);

        $project->skills()->sync($request->skills);

        return redirect()
        ->route('company.projects.index')
        ->with('msg', 'Project updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        File::delete(public_path('images/',$project->image));
        $project->delete();

        return redirect()
        ->route('company.projects.index')
        ->with('msg', 'Project deleted successfully')
        ->with('type', 'danger');
    }

    function edit_status(Project $project) {
        $project->update(['status' => !$project->status]);

        return $project->status;
    }
}
