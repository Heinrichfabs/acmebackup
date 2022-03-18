@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
    <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
    <a href="diseaseinjury/create" class="p-3 border-none italic text-white bg-black text-lg">
        Add a new disease/injury &rarr;
    </a>
</div>

<div class="py-3">
    <table class="table-auto">
        <tr class="text-white text-center">
            <th class="w-screen text-3xl">Id</th>
            <th class="w-screen text-3xl">Classify</th>
            <th class="w-screen text-3xl">Animal Name</th>
            <th class="w-screen text-3xl">Update</th>
            <th class="w-screen text-3xl">Delete</th>
            <th class="w-screen text-3xl">Restore</th>
            <th class="w-screen text-3xl">Destroy</th>
        </tr>

        @forelse ($disease_injuries as $disease_injury)
        <tr>
            <td class=" text-center text-3xl">
                {{ $disease_injury->id }}
            </td>
            <td class=" text-center text-3xl">
                {{ $disease_injury->classify }}
            </td>
            <td class=" text-center text-3xl">
                {{ $disease_injury->animal_name }}
            </td>
            <td class=" text-center">
                <a href="diseaseinjury/{{ $disease_injury->id }}/edit" class="text-center text-3xl bg-green-600 p-2">
                    Update &rarr;
                </a>
            </td>
            <td class=" text-center">
                {!! Form::open(array('route' => array('diseaseinjury.destroy', $disease_injury->id),'method'=>'DELETE'))
                !!}
                <button type="submit" class="text-center text-3xl bg-red-600 p-2 ml-6 my-1">
                    Delete &rarr;
                </button>
                {!! Form::close() !!}
            </td>
            @if($disease_injury->deleted_at)
            <td>
                <a href="{{ route('diseaseinjury.restore', $disease_injury->id) }}">
                    <button class="text-center text-red-700 text-3xl bg-purple-500 p-2 ml-16">
                        Restore &rarr;
                    </button>
                </a>
            </td>
            @else
            <td>
                <a href="#"><button class="text-center text-3xl bg-purple-500 p-2 ml-16">
                        Restore &rarr;
                    </button>
                </a>
            </td>
            @endif
            <td>
                <a href="{{ route('diseaseinjury.forceDelete', $disease_injury->id) }}">
                    <button class="text-center text-3xl bg-warning p-2 ml-16"
                        onclick="return confirm('Do you want to delete this data permanently?')">
                        Destroy &rarr;
                    </button>
                </a>
            </td>
        </tr>
        @empty
        <p>No Disease/Injury Data in the Database</p>
        @endforelse
    </table>
    <div class="pt-6 px-4">{{ $disease_injuries->links()}}</div>
</div>
</div>
@endsection