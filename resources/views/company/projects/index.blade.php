@extends('company.master')

@section('title', 'Company Dashboard | ' . env('APP_NAME'))

@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container {
        width: 100% !important;
    }
    .select2-container .select2-selection--multiple {
        min-height: 38px
    }
    table span {
        cursor: pointer;
    }
</style>
@endsection

@section('content')

<!-- Button trigger modal -->
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
      All Projects
      <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#addProject">Add new Project</a>
    </div>
    <div class="card-body">
        @if (session('msg'))
            <div class="alert alert-{{ session('type') }}">
                {{ session('msg') }}
            </div>
        @endif
        <div class="content-wrapper">
            @include('company.projects._table')
        </div>
    </div>
  </div>
@endsection

@section('js')



  <!-- Modal -->
  <div class="modal fade" id="addProject" tabindex="-1" aria-labelledby="addProjectLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addProjectLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form  action="{{ route('company.projects.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    <small class="text-danger"></small>
                    @error('name')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    <small class="text-danger"></small>
                    @error('image')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Content</label>
                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="5">{{ old('content') }}</textarea>
                    <small class="text-danger"></small>
                    @error('content')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="number" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
                    <small class="text-danger"></small>
                    @error('price')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Duration</label>
                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}">
                    <small class="text-danger"></small>
                    @error('duration')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label>Category</label>
                    <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                        <option value=""> -- Select Category -- </option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="invalid-feedback">{{ $message }}</small>
                    @enderror
                    <small class="text-danger"></small>
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
                    <small class="text-danger"></small>
                </div>
                <button class="btn btn-success px-4"><i class="fas fa-save"></i> Add</button>
            </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
        $('.select-skills').select2();
    });

    function editStatus(e, id) {
        // console.log(id);
        // axios.get().then()

        $.ajax({
            type: 'get',
            url: '{{ route("company.projects.edit_status") }}/'+id,
            success: (res) => {
                if(res) {
                    e.target.classList.remove('badge-danger')
                    e.target.classList.add('badge-success')
                    e.target.innerHTML = 'Open'
                }else {
                    e.target.classList.remove('badge-success')
                    e.target.classList.add('badge-danger')
                    e.target.innerHTML = 'Close'
                }
            }
        })
    }

    document.querySelector('.modal form').onsubmit = (e) => {

    // function storeProject(e) {
        e.preventDefault();

        let data = new FormData(e.target);

        let url = e.target.action;

        axios.post(url, data)
        .then(res => {
            document.querySelector('.content-wrapper').innerHTML = res.data
            $('#addProject').modal('hide')
        }).catch(err => {
            let fields = document.querySelectorAll('.modal form .form-control,.modal form select')
            fields.forEach(el => {
                let name = el.name.replace('[]', '')
                if(err.response.data.errors[name]) {
                    el.classList.add('is-invalid')
                    // el.nextElementSibling.innerHTML = err.response.data.errors[el.name][0]
                    el.closest('.mb-3').querySelector('.text-danger').innerHTML = err.response.data.errors[name][0]
                }else {
                    el.classList.remove('is-invalid')
                    el.closest('.mb-3').querySelector('.text-danger').innerHTML = ''
                }
            });
            // console.log(fields);
            // console.log(err.response.data.errors.name);
        });
    }



    $('.pagination a').click(function(e) {
        e.preventDefault()

        let url = $(this).attr('href')

        $.ajax({
            type: 'get',
            url: url,
            success: (res) => {
                document.querySelector('.content-wrapper').innerHTML = res
            }
        })
        // axios.get(url)
        // .then(res => {
        //     console.log(res);
        // })
    })

</script>

@endsection
