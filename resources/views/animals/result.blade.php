@extends('homepage')

@section('contents')

<!DOCTYPE html>
<html lang="en">
<br>
<br>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>Search Pets</title>
</head>

<body>
    @forelse ($animals as $animal)
    <h1 class="text-center text-5xl pb-8 text-blue-600">The Pet You've Searched is Available!!</h1>
    <hr>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-black text-center">
                <th class="w-screen text-3xl">Id</th>
                <th class="w-screen text-3xl">Animal Name</th>
                <th class="w-screen text-3xl">Age</th>
                <th class="w-screen text-3xl">Gender</th>
                <th class="w-screen text-3xl">Type of Animal</th>
                <th class="w-screen text-3xl">Animal Pic</th>
            </tr>

            <tr>
                <td class=" text-center text-3xl">
                    {{ $animal->id }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->animal_name }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->age }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->gender }}
                </td>
                <td class=" text-center text-3xl">
                    {{ $animal->type }}
                </td>
                <td class="pl-32">
                    <img src="{{ asset('uploads/animals/'.$animal->images)}}" alt="I am A Pic" width="75" height="75">
                </td>
                @empty
                <p class="text-center text-3xl py-8">404 Pet Not Found</p>
                @endforelse
        </table>
    </div>
    </tr>
  

    <div class="flex justify-end">
        <a href="{{url()->previous()}}" class="bg-gray-800 text-white text-2xl font-bold p-2 mr-10 text-center"
            role="button">Go Back &rarr;</a>
    </div>
</body>
<section class="about">
    <h2>Contact Us!</h2>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Labore asperiores neque perferendis aliquam similique reprehenderit? Repellat consequuntur sapiente facilis recusandae, ut voluptas ab consequatur dolore eligendi iure, dolorem quia soluta?<br>
 Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aspernatur saepe quia tenetur harum consequatur? Enim voluptatem culpa minus, nemo distinctio optio quaerat exercitationem facere quos et impedit consequatur odit aspernatur?<br>
Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptate id, dolor incidunt magnam maiores labore optio blanditiis ut deserunt a quaerat accusamus inventore mollitia eum ullam voluptates delectus animi placeat!</p>
</section>
<footer>
    <p class="copyright">Copyright 2022 ACME</p>
</footer>
</html>
@endsection