<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Read Notifications</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        .list-group-item span {
            width: 10px;
            height: 10px;
            display: inline-block;
            background: #b1dcff;
            border-radius: 50%;
            margin-right: 5px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>All Notifications ({{ $admin->notifications->count() }})</h2>
        <div class="list-group">
            @foreach ($admin->notifications as $item)
                <a href="{{ route('mark_read', $item->id) }}" class="list-group-item list-group-item-action"> @if (!$item->read_at) <span></span> @endif {{ $item->data['msg'] }}</a>
            @endforeach

          </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        let userId = '{{ Auth::guard("admin")->id() }}'
    </script>
    @vite('resources/js/app.js')
</body>
</html>
