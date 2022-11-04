<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{asset('/assets/bootstrap/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/fontawesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/main.css')}}">
</head>
<body>
    @include('partials.header')
    <main id="auth-main">
        <div class="container" id="main-container">
            @yield('content')
        </div>
    </main>
    @include('partials.footer')
</body>
</html>