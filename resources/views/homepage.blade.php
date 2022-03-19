@extends('layouts.app')

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
                <li> <a href="{{ URL('homewelcome') }}">Home</a></li>     
                <li> <a href="{{ URL('search') }}">Search</a></li>
                <li> <a href="{{ URL('login') }}">Login</a></li>        
                <li> <a href="{{ URL('register') }}">Register</a></li>    
            </ul>
    </nav>
    @yield('contents')