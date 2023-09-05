<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <style>
        form {
            position: relative;
        }

        form span {
            position: absolute;
            right: 10px;
            top: 12px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container my-5">

        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="mb-4">Weather App</h1>
                <form action="">
                    <input type="text" placeholder="Enter City name.." class="form-control form-control-lg">
                    <span><i class="fas fa-spinner fa-spin"></i></span>
                </form>

                <div class="info mt-3 d-none">
                    <h3>Weather in <span id="city"></span></h3>
                    <h2><span id="weather"></span> °C</h2>
                </div>

                <div class="alert alert-danger mt-3 d-none">
                    <p class="m-0">No data found</p>
                </div>
            </div>
        </div>


    </div>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        document.querySelector('form').onsubmit = (e) => {
            e.preventDefault()

            document.querySelector('form span').style.display = 'inline'

            let city = document.querySelector('form input').value;

            // Send Ajax Request to API
            let url = "https://api.openweathermap.org/data/2.5/weather"
            // let url = "https://api.openweathermap.org/data/2.5/weather?q="+city+"&appid=dccab945679f3bb9019537a309e05e47&units=metric"

            axios.get(url, {
                params: {
                    q: city,
                    appid: 'dccab945679f3bb9019537a309e05e47',
                    units: 'metric'
                }
            })
            .then(res => {
                document.querySelector('form span').style.display = 'none'
                document.querySelector('.alert-danger').classList.add('d-none')

                document.querySelector('.info').classList.remove('d-none')

                document.querySelector('#city').innerHTML = city
                document.querySelector('#weather').innerHTML = res.data.main.temp

            })
            .catch(err => {
                document.querySelector('.info').classList.add('d-none')
                document.querySelector('.alert-danger').classList.remove('d-none')
            })
        }
    </script>
</body>
</html>
