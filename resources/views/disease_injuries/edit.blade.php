@extends('home')

@section('contents')
<div class="pb-20 my-2">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Disease/Injury
        </h1>
    </div>
    <div>
        <div class="flex justify-center pt-4">
            {!! Form::model($disease_injuries,['method'=>'PUT','route' =>
            ['diseaseinjury.update',$disease_injuries->id]]) !!}
            <div class="block">

                <div>
                    <label for="classify" class="text-lg">Classify</label>
                    {!! Form::text('classify',$disease_injuries->classify,array('class' =>
                    'block shadow-5xl p-2 my-2 w-full')) !!}
                    @if($errors->has('classify'))
                    <p class="text-center text-red-500">{{ $errors->first('classify') }}</p>
                    @endif
                </div>

                <div>
                    <label class="block text-lg pb-2">Animals</label>
                    @foreach ($animals as $animals_id => $animal)
                    <div class="inline">
                        @if (in_array($animals_id, $animal_disease_injury))
                        {!!Form::label('animals', $animal,array('class'=>'inline-block w-1/5')) !!}
                        {!! Form::checkbox('animals_id[]',$animals_id, true, array('class'=>'inline-block
                        w-1/5','animals_id'=>'animals')) !!}
                        @else
                        {!!Form::label('animals', $animal,array('class'=>'inline-block w-1/5')) !!}
                        {!! Form::checkbox('animals_id[]',$animals_id, null, array('class'=>'inline-block
                        w-1/5','id'=>'animals')) !!}
                        @endif
                        @endforeach
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center"
                            role="button">Cancel</a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
            @endsection