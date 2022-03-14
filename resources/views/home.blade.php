<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="/css/styles.css">
    
</head>
<header>
    <h1>AC <span>ME</span></h1>
    <p>pet clinic</p>
</header>

<body>
    <section class="banner">
        <img src="/img/banner.jpg" alt="acmebanner">
    </section>
    <nav class="main-nav">
            <ul>
                <li> <a href="{{ URL('dashboard') }}">Home</a></li>
                <li> <a href="{{ URL('animals') }}">Animals</a></li>
                <li><a href="{{ URL('rescuer') }}">Rescuers</a></li>
                <li><a href={{ URL('personnel') }}>Personnel</a></li>
                <li><a href="{{ URL('diseaseinjury') }}">Disease / Injury</a></li>
                <li><a href="{{ URL('adopter') }}">Adopters</a></li>
            </ul>
    </nav>
    @yield('contents')
</body>
</html>