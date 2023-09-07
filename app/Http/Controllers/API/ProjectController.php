<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectsResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = ProjectsResource::collection(Project::all());
        return $this->res($projects, 'All Projects');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // if(!$request->has('appid') || $request->appid != '123456') {
        //     return $this->res([], 'Unauthorized', 401, false);
        // }

        $request->validate([
            'name' => 'required',
            'image' => 'required',
            'content' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'category_id' => 'required|exists:categories,id',
            'company_id' => 'required',
        ]);

        $img_name = rand().time().$request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('images'),$img_name);

        $data = $request->except('image', 'appid');
        $data['image'] = $img_name;
        $data['company_id'] = 1;

        // dd($data);
        $project = Project::create($data);

        return $this->res(new ProjectsResource($project), 'Project ' . $project->name . ' created', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        if(!$project) {
            return $this->res([], 'No Data found', 404, false);
        }

        return $this->res(new ProjectsResource($project), 'Found Project ' . $project->name);
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

    private function res($data, $message = '', $code = 200, $status = true) {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
    }
}
