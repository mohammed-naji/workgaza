@extends('admin.master')

@section('title', 'All Roles | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Roles</h1>

@if (session('msg'))
    <div class="alert alert-{{ session('type') }}">
        {{ session('msg') }}
    </div>
@endif

<table class="table table-bordered text-center" >
    <tr class="bg-dark text-white">
        <th style="width: 10%">ID</th>
        <th>Name</th>
        <th style="width: 20%">Created At</th>
        <th style="width: 15%">Actions</th>
    </tr>

    @foreach ($roles as $role)
        <tr>
            <td>{{ $role->id }}</td>
            <td>{{ $role->name }}</td>
            <td>{{ $role->created_at->format('M d, Y : h:i:s a') }}</td>
            <td>
                <a class="btn btn-dark btn-sm" href="{{ route('admin.roles.edit', $role) }}"><i class="fas fa-edit"></i></a>
                <form class="d-inline" action="{{ route('admin.roles.destroy', $role->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $roles->links() }}
@endsection
