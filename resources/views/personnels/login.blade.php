<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Log In</title>
</head>
<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    <div class="pt-48 my-5">
        <div class="text-center">
            <h1 class="text-5xl">
                Log In
            </h1>
        </div>
    <div>

        <div class="flex justify-center pt-8">
            <form action="{{ route('check') }}" method="POST">
                @csrf
                <div class="block">
                    <label for="email" class="text-lg">Email</label>
                    <input type="email"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="email"
                    placeholder="Enter your Email">

                    <label for="password" class="text-lg">Password</label>
                    <input type="password"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="password"
                    placeholder="Enter your password">

                    <a href="/personnel/create" class="bg-green-600 p-2 ml-12 text-white">Sign up Here</a>

                    <button type="submit" class="bg-gray-800 text-white block p-2 mt-5 w-full font-bold">
                        Log In
                    </button>

                    
                </div>
            </form>
        </div>
</body>
</html>