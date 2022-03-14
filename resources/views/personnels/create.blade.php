<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">

<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Personnel
        </h1>
    </div>
<div>

        <div class="flex justify-center pt-3">
            <form action="/personnel" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                    <label for="full_name" class="text-lg">Full Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="full_name"
                    placeholder="Full Name"
                    value="{{old('full_name')}}">
                    @if($errors->has('full_name'))
                    <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="email" class="text-lg">Email</label>
                    <input type="email"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="email"
                    placeholder="Enter your Email"
                    value="{{old('email')}}">
                    @if($errors->has('email'))
                    <p class="text-center text-red-500">{{ $errors->first('email') }}</p>
                    @endif 
                    </div>
    
                    <div>
                    <label for="password" class="text-lg">Password</label>
                    <input type="password"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="password"
                    placeholder="Enter your Password"
                    value="{{old('password')}}">
                    @if($errors->has('password'))
                    <p class="text-center text-red-500">{{ $errors->first('password') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="role" class="text-lg">Pick Your Role</label>
                    <select name="role" class="block shadow-5xl p-2 my-5 w-full" value="{{old('role')}}">
                      <option>Employee</option>
                      <option>Veterinarian</option>
                      <option>Volunteer</option>
                    </select>
                    @if($errors->has('role'))
                    <p class="text-center text-red-500">{{ $errors->first('role') }}</p>
                    @endif 
                    </div>

                   <div>
                   <label for="images" class="text-lg">Personnel Pic</label>
                   <input type="file"
                   class="block shadow-5xl p-2 w-full"
                   name="images"
                   value="{{old('images')}}">
                   @if($errors->has('images'))
                   <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                   @endif 
                   </div>
                   
                    <div class="grid grid-cols-2 gap-2 w-full">
                    <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                        Submit
                    </button>
                    <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center" role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>