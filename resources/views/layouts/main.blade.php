<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hacker News Clone | {{ucfirst(Request::segment(1))}}</title>
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">
</head>
<body>
    @include('partials.header')
    <div class="cover-loader"></div>
    <main style="position: relative">
        <div class="container" id="main-container">
            @yield('content')
        </div>
    </main>
    @include('partials.footer')
    <script src="{{asset('/assets/js/jquery-3.6.1.js')}}"></script>
    <script src="{{asset('/assets/bootstrap/js/bootstrap.js')}}"></script>
    <script src="{{asset('/assets/js/main.js')}}"></script>
</body>
</html>