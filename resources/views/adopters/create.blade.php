@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Add Adopter
        </h1>
    </div>
    <div>

        <div class="flex justify-center pt-3">
            <form action="/adopter" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="block">
                    <div>
                        <label for="first_name" class="text-lg">First Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="first_name" name="first_name"
                            placeholder="First Name" value="{{old('first_name')}}">
                        @if($errors->has('first_name'))
                        <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="last_name" class="text-lg">Last Name</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="last_name" name="last_name"
                            placeholder="Last Name" value="{{old('last_name')}}">
                        @if($errors->has('last_name'))
                        <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="phone_number" class="text-lg" r">Phone Number</label>
                        <input type="text" class="block shadow-5xl p-2 my-2 w-full" id="phone_number"
                            name="phone_number" placeholder="phone_number" value="{{old('phone_number')}}">
                        @if($errors->has('phone_number'))
                        <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                        @endif
                    </div>

                    <div>
                        <label for="images" class="text-lg">Adopter Pic</label>
                        <input type="file" class="block shadow-5xl p-2 w-full" id="images" name="images"
                            value="{{old('images')}}">
                        @if($errors->has('images'))
                        <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                        @endif
                    </div>

                    <div class="inline">
                        <label class="block text-lg pb-2">Animals</label>
                        @foreach ($animals as $animals_id => $animal)
                        {!!Form::label('animals', $animal,array('class'=>'inline-block w-1/12')) !!}
                        {!! Form::checkbox('animals_id[]',$animals_id, null, array('class'=>'inline-block
                        w-1/12','id'=>'animals')) !!}
                        @endforeach

                        <div class="grid grid-cols-2 gap-2 w-full">
                            <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                                Submit
                            </button>
                            <a href="{{url()->previous()}}"
                                class="bg-gray-800 text-white font-bold p-2 mt-5 text-center" role="button">Cancel</a>
                        </div>
                    </div>
            </form>
        </div>
        @endsection