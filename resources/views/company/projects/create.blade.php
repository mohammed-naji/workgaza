@extends('company.master')

@section('title', 'Company Dashboard | ' . env('APP_NAME'))

@section('content')

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select-skills').select2();
    });
</script>

@endsection

<div class="card">
    <div class="card-header">
      Add new Project
    </div>
    <div class="card-body">
        <form action="{{ route('company.projects.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                @error('name')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Image</label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Content</label>
                <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content') }}</textarea>
                @error('content')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                @error('price')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Duration</label>
                <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}">
                @error('duration')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Category</label>
                <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label>Skills</label>
                <select class="select-skills form-control @error('skills') is-invalid @enderror" name="skills[]" multiple="multiple">
                    @foreach ($skills as $skill)
                        <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                    @endforeach
                </select>
                @error('skills')
                    <small class="invalid-feedback">{{ $message }}</small>
                @enderror
            </div>
            <button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
        </form>
    </div>
  </div>

@endsection
