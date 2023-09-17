@extends('admin.master')

@section('title', 'All Roles | ' . env('APP_NAME'))

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">All Roles</h1>
<form action="{{ route('admin.roles.store') }}" method="POST">
@csrf
<div class="mb-3">
    <label>Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
    @error('name')
        <small class="invalid-feedback">{{ $message }}</small>
    @enderror
</div>

<div class="mb-3">
    <label>Role Permissions</label> <br>
    <label><input type="checkbox" id="check_all"> Check All</label>
    <ul class="list-unstyled" style="column-count: 3">
        @foreach ($permissions as $p)
            <li><label><input type="checkbox" name="abilities[]" value="{{ $p->id }}"> {{ $p->name }}</label></li>
        @endforeach
    </ul>
</div>

<button class="btn btn-success"><i class="fas fa-save"></i> Add</button>
</form>
@endsection

@section('js')

<script>
    $(document).ready(function(){
        $('#check_all').change(function() {
            $('ul input').prop('checked', this.checked)
        })
    });
</script>

@endsection
