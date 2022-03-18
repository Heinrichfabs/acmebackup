@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Animal
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/animals" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="animal_name" class="text-lg">Animal Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="animal_name" name="animal_name"
                            placeholder="Animal Name" value="{{old('animal_name')}}">
                        @if($errors->has('animal_name'))
                        <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="age" class="text-lg">Age</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="age" name="age"
                            placeholder="Age" value="{{old('age')}}">
                        @if($errors->has('age'))
                        <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="gender" class="text-lg">Gender</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="gender" name="gender"
                            placeholder="Gender" value="{{old('gender')}}">
                        @if($errors->has('gender'))
                        <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="type" class="text-lg">Type</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="type" name="type"
                            placeholder="Type of Animal" value="{{old('type')}}">
                        @if($errors->has('type'))
                        <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Animal Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="images" name="images"
                            value="{{old('images')}}">
                        @if($errors->has('images'))
                        <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <label for="rescuer_id" class="text-lg">Rescuer</label>
                    <select name="rescuer_id" id="rescuer_id" class="block shadow-5xl p-2 w-full">
                        @foreach ($rescuers as $id => $rescuer)
                        <option value="{{ $id }}">{{ $rescuer }}</option>
                        @endforeach
                    </select>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        @endsection