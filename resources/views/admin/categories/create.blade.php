@extends('admin.master')

@section('title', 'All Categories | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Categories</h1>
<form action="{{ route('admin.categories.store') }}" method="POST">
@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
    @error('name')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>
<button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
</form>
@endsection
