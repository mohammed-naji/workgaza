@extends('admin.master')

@section('title', 'All Categories | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Categories</h1>

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

    @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->created_at->format('M d, Y : h:i:s a') }}</td>
            <td>
                <a class="btn btn-dark btn-sm" href="{{ route('admin.categories.edit', $category) }}"><i class="fas fa-edit"></i></a>
                <form class="d-inline" action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
{{ $categories->links() }}
@endsection
