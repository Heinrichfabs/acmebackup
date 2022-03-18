@extends('layouts.app')

@section('content')

@if ($message = Session::get('success'))
<div class="bg-red-500 p-4">
  <strong class="text-white text-3xl pl-4">{{ $message }}</strong>
</div>
@endif

<div class="pt-8 pb-4 px-8">
  <a href="rescuer/create" class="p-3 border-none italic text-white bg-black text-lg">
    Add a new rescuer &rarr;
  </a>
</div>

<div class="py-3">
  <table class="table-auto text-center">
    <tr class="text-white">
      <th class="w-screen text-3xl">Id</th>
      <th class="w-screen text-3xl">First Name</th>
      <th class="w-screen text-3xl">Last Name</th>
      <th class="w-screen text-3xl">Phone Number</th>
      <th class="w-screen text-3xl">Rescuer Pic</th>
      <th class="w-screen text-3xl">Rescued Animal</th>
      <th class="w-screen text-3xl">Update</th>
      <th class="w-screen text-3xl">Delete</th>
      <th class="w-screen text-3xl">Restore</th>
      <th class="w-screen text-3xl">Destroy</th>
    </tr>

    @forelse ($rescuers as $rescuer)

    <tr>
      <td class=" text-center text-3xl">
        {{ $rescuer->id }}
      </td>
      <td class=" text-center text-3xl">
        {{ $rescuer->first_name }}
      </td>
      <td class=" text-center text-3xl">
        {{ $rescuer->last_name }}
      </td>
      <td class=" text-center text-3xl">
        {{ $rescuer->phone_number }}
      </td>
      <td class="pl-10">
        <img src="{{ asset('uploads/rescuers/'.$rescuer->images)}}" alt="I am A Pic" width="75" height="75">
      </td>
      <td class=" text-center text-3xl">
        {{ $rescuer->animal_name }}
      </td>
      <td class=" text-center">
        <a href="rescuer/{{ $rescuer->id }}/edit" class="text-center text-2xl bg-green-600 p-2">
          Update &rarr;
        </a>
      </td>
      <td class=" text-center">
        {!! Form::open(array('route' => array('rescuer.destroy', $rescuer->id),'method'=>'DELETE')) !!}
        <button type="submit" class="text-center text-2xl bg-red-600 p-2 my-2">
          Delete &rarr;
        </button>
        {!! Form::close() !!}
      </td>

      @if($rescuer->deleted_at)
      <td>
        <a href="{{ route('rescuer.restore', $rescuer->id) }}">
          <p class="text-center text-red-700 text-2xl bg-purple-500 p-2 my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @else
      <td>
        <a href="#">
          <p class="text-center text-2xl bg-purple-500 p-2 my-2">
            Restore &rarr;
          </p>
        </a>
      </td>
      @endif

      <td>
        <a href="{{ route('rescuer.forceDelete', $rescuer->id) }}">
          <p class="text-center text-2xl bg-warning p-2 ml-3 mr-4 my-2"
            onclick="return confirm('Do you want to delete this data permanently?')">
            Destroy &rarr;
          </p>
        </a>
      </td>
    </tr>
    @empty
    <p>No Rescuer Data in the Database</p>
    @endforelse
  </table>
  <div class="pt-6 px-4">{{ $rescuers->links( )}}</div>
</div>
</div>
@endsection