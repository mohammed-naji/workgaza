@extends('company.master')

@section('title', 'Company Dashboard | ' . env('APP_NAME'))

@section('content')

<div class="card">
    <div class="card-header">
      All Projects
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
            @forelse ($projects as $project)
            <tr>
                <td>{{ $project->id }}</td>
                <td>{{ $project->image }}</td>
                <td>{{ $project->name }}</td>
                <td>{{ $project->price }}</td>
                <td>{{ $project->duration }}</td>
                <td>{{ $project->status }}</td>
                <td>{{ $project->category_id }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="{{ route('company.projects.edit', $company) }}"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('company.projects.destroy', $company) }}">
                    @csrf
                    @method('delete')
                    <button onclick="return confirm('Are you sure?!')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                    </form>
                </td>
            </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No Data Found</td>
                </tr>
            @endforelse
        </table>
    </div>
  </div>

@endsection
