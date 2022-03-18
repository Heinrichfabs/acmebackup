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
    style="background-image:linear-gradient(rgba(212, 212, 212, 0.1),rgba(212,212,212,0.1)), url(https://wallpapercave.com/wp/B1sODrM.jpg); background-size:cover;">
    @forelse ($animals as $animal)
    <h1 class="text-center text-5xl pb-8 text-blue-600">This Pet Is Adoptable! Congratulations!</h1>
    <hr>
    <div class="py-3">
        <table class="table-auto">
            <tr class="text-white text-center">
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
                <p class="text-center text-3xl py-8">The Animal You Search Is Not In The Database.</p>
                @endforelse
        </table>
    </div>
    </tr>
    <hr>
    <h1 class="text-center text-5xl pb-8 text-red-600">Thank you for Choosing ACME Pet Clinic</h1>
    <div class="flex justify-end">
        <a href="{{url()->previous()}}" class="bg-gray-800 text-white text-2xl font-bold p-2 mr-10 text-center"
            role="button">Go Back &rarr;</a>
    </div>
</body>

</html>