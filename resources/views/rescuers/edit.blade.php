@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Rescuer
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($rescuers,['route' => ['rescuer.update',$rescuers->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="first_name" class="text-lg">First Name</label>
                    {{ Form::text('first_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'first_name')) }}
                    @if($errors->has('first_name'))
                    <p class="text-center text-red-500">{{ $errors->first('first_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="last_name" class="text-lg">Last_name</label>
                    {{ Form::text('last_name',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'last_name'))
                    }}
                    @if($errors->has('last_name'))
                    <p class="text-center text-red-500">{{ $errors->first('last_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="phone_number" class="text-lg">Phone Number</label>
                    {{ Form::text('phone_number',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'phone_number')) }}
                    @if($errors->has('phone_number'))
                    <p class="text-center text-red-500">{{ $errors->first('phone_number') }}</p>
                    @endif
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Adopter Pic</label>
                    {{ Form::file('images',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'images')) }}
                    <img src="{{ asset('uploads/rescuers/'.$rescuers->images)}}" alt="I am A Pic" width="100"
                        height="100" class="ml-24 py-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif
                </div>

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