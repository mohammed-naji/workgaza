<table class="table table-bordered mb-3">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Price</th>
        <th>Duration</th>
        <th>Status</th>
        <th>Skills</th>
        <th>Category</th>
        <th>Payment</th>
        <th>Actions</th>
    </tr>
    @forelse ($projects as $project)
    <tr>
        <td>{{ $project->id }}</td>
        <td><img width="80" src="{{ asset('images/'.$project->image) }}" alt=""></td>
        <td>{{ $project->name }}</td>
        <td>{{ $project->price }}</td>
        <td>{{ $project->duration }}</td>
        <td>{!! $project->status ? '<span onclick="editStatus(event, '.$project->id.')" class="badge badge-success">Open</span>' : '<span onclick="editStatus(event, '.$project->id.')"  class="badge badge-danger">Close</span>' !!}</td>
        <td>
            @foreach ($project->skills as $skill)
                <small class="badge badge-info">{{ $skill->name }}</small>
            @endforeach
        </td>
        <td>{{ $project->category->name }}</td>
        <td>

            @if ($project->payment)
                <small>Payed at {{ $project->payment->created_at }}</small>
            @else
                <a class="btn btn-success btn-sm" href="{{ route('company.project_pay', $project->id) }}">Pay Now</a>
            @endif



        </td>
        <td>
            <a class="btn btn-primary btn-sm" href="{{ route('company.projects.edit', $project) }}"><i class="fas fa-edit"></i></a>
            <form class="d-inline" action="{{ route('company.projects.destroy', $project) }}" method="POST">
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
{{ $projects->links() }}
