@extends('homepage')

@section('contents')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Search Pets</title>
</head>

<body
    <div class="pt-4 pb-20 my-5">
        <div class="text-center">
            <h1 class="text-5xl"> Search Adoptable Animals</h1>
            <div class="flex justify-center pt-4">
                <form action="{{ url('result') }}" type="GET">
                    <input type="result" name="result" id="result" placeholder="Search"class="text-center pb-1 px-2 mr-4 w-full">
                   
                        <button class="bg-green-800 text-black font-bold p-2 mt-5">Search</button>
                        <a href="{{url('login') }}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Back</a>
                
                </form>
            </div>
        </div>
      
        
        <div class="py-3">
            <table class="table-auto">
                <tr class="text-black text-center">
                    <th class="w-screen text-3xl">Id</th>
                    <th class="w-screen text-3xl">Animal Name</th>
                    <th class="w-screen text-3xl">Age</th>
                    <th class="w-screen text-3xl">Gender</th>
                    <th class="w-screen text-3xl">Type of Animal</th>
                    <th class="w-screen text-3xl">Disease/Injury</th>
                    <th class="w-screen text-3xl">Animal Pic</th>
                </tr>

                @forelse ($animals as $animal)
                <tr>
                    <td class=" text-center text-4xl">
                        {{ $animal->id }}
                    </td>
                    <td class=" text-center text-4xl">
                        {{ $animal->animal_name }}
                    </td>
                    <td class=" text-center text-4xl">
                        {{ $animal->age }}
                    </td>
                    <td class=" text-center text-4xl">
                        {{ $animal->gender }}
                    </td>
                    <td class=" text-center text-4xl">
                        {{ $animal->type }}
                    </td>
                    <td class=" text-center text-4xl text-red-600">
                        {{ $animal->classify }}
                    </td>
                    <td class="pl-20">
                        <img src="{{ asset('uploads/animals/'.$animal->images)}}" alt="I am A Pic" width="75"
                            height="75">
                    </td>
                    @empty
                    <p>No Animals Data in the Database</p>
                    @endforelse
            </table>
        </div>
        </tr>
     
</body>

</html>
@endsection