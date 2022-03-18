@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Animals
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {{ Form::model($animals,['route' => ['animals.update',$animals->id],'method'=>'PUT',
            'enctype'=>'multipart/form-data']) }}
            <div class="block">
                <div>
                    <label for="animal_name" class="text-lg">Animal Name</label>
                    {{ Form::text('animal_name',null,array('class'=>'block shadow-5xl p-2 my-2
                    w-full','id'=>'animal_name')) }}
                    @if($errors->has('animal_name'))
                    <p class="text-center text-red-500">{{ $errors->first('animal_name') }}</p>
                    @endif
                </div>

                <div>
                    <label for="age" class="text-lg">Age</label>
                    {{ Form::text('age',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'age')) }}
                    @if($errors->has('age'))
                    <p class="text-center text-red-500">{{ $errors->first('age') }}</p>
                    @endif
                </div>

                <div>
                    <label for="gender" class="text-lg">Gender</label>
                    {{ Form::text('gender',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'gender')) }}
                    @if($errors->has('gender'))
                    <p class="text-center text-red-500">{{ $errors->first('gender') }}</p>
                    @endif
                </div>

                <div>
                    <label for="type" class="text-lg">Type</label>
                    {{ Form::text('type',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'type')) }}
                    @if($errors->has('type'))
                    <p class="text-center text-red-500">{{ $errors->first('type') }}</p>
                    @endif
                </div>

                <div>
                    <label for="images" class="block text-lg pb-3">Adopter Pic</label>
                    {{ Form::file('images',null,array('class'=>'block shadow-5xl p-2 my-2 w-full','id'=>'images')) }}
                    <img src="{{ asset('uploads/animals/'.$animals->images)}}" alt="I am A Pic" width="100" height="100"
                        class="ml-24 py-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif
                </div>

                <div>
                    <label for="rescuer_id" class="text-lg">Type</label>
                    {!! Form::select('rescuer_id',$rescuers, $animals->rescuer_id,['class' => 'block shadow-5xl p-2 my-2
                    w-full']) !!}
                    @if($errors->has('rescuer_id'))
                    <p class="text-center text-red-500">{{ $errors->first('rescuer_id') }}</p>
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