<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::latest('id')->paginate(20);

        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // validation
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        // upload file

        // store database
        $role = Role::create([
            'name' => $request->name
        ]);

        $role->permissions()->sync($request->abilities);

        // redirect
        return redirect()
        ->route('admin.roles.index')
        ->with('msg', 'Role added successfully')
        ->with('type', 'success');

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
    public function edit(Role $role)
    {
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        // validation
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);

        // upload file

        // store database
        $role->update([
            'name' => $request->name
        ]);

        // redirect
        return redirect()
        ->route('admin.roles.index')
        ->with('msg', 'Role updated successfully')
        ->with('type', 'info');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Role::destroy($id);
        return redirect()
        ->route('admin.roles.index')
        ->with('msg', 'Role deleted successfully')
        ->with('type', 'warning');
    }
}
