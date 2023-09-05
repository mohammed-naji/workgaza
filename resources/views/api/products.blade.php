<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card img {
            height: 250px;
            object-fit: contain;
            /* object-fit: cover; */
            background: #f7f7f7;
        }

        .card-title {
            height: 48px;
        }

        .card-text {
            height: 72px;
        }
    </style>
</head>
<body>

    <div class="container my-5">

        <h1>API Products</h1>

        <div class="row">
            @foreach ($data['products'] as $product)
            <div class="col-md-3 mb-4">
                <div class="card">
                    <img src="{{ $product['thumbnail'] }}" class="card-img-top" alt="{{ $product['title'] }}">
                    <div class="card-body">
                      <h5 class="card-title">{{ $product['title'] }}</h5>
                      <p class="card-text">{{ Str::words($product['description'], 8, '...') }}</p>
                      <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                  </div>
            </div>
            @endforeach
        </div>

    </div>

</body>
</html>
