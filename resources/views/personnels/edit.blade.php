@extends('home')

@section('contents')
<div class="pb-20 my-5">
    <div class="text-center">
        <h1 class="text-5xl">
            Update Personnel
        </h1>
    </div>
<div>
        <div class="flex justify-center pt-4">
            <form action="/personnel/{{ $personnels->personnel_id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="block">
                    <div>
                    <label for="full_name" class="text-lg">Full Name</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="full_name"
                    value="{{ $personnels->full_name }}">
                    @if($errors->has('full_name'))
                    <p class="text-center text-red-500">{{ $errors->first('full_name') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="email" class="text-lg">Email</label>
                    <input type="text"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="email"
                    value="{{ $personnels->email }}">
                    @if($errors->has('email'))
                    <p class="text-center text-red-500">{{ $errors->first('email') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="password" class="text-lg">Password</label>
                    <input type="password"
                    class="block shadow-5xl p-2 my-5 w-full"
                    name="password"
                    value="{{old('password')}}">
                    @if($errors->has('password'))
                    <p class="text-center text-red-500">{{ $errors->first('password') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="role" class="text-lg">Pick Your Role</label>
                    <select name="role" class="block shadow-5xl p-2 my-5 w-full" value="{{ $personnels->role }}">
                      <option>Employee</option>
                      <option>Veterinarian</option>
                      <option>Volunteer</option>
                    </select>
                    @if($errors->has('role'))
                    <p class="text-center text-red-500">{{ $errors->first('role') }}</p>
                    @endif 
                    </div>

                    <div>
                    <label for="images" class="text-lg">Personnel Pic</label>
                    <input type="file"
                    class="block shadow-5xl p-2 w-full"
                    name="images">
                    <img src="{{ asset('uploads/personnels/'.$personnels->images)}}" alt="I am A Pic" width="100" height="100" class="ml-24 pb-2">
                    @if($errors->has('images'))
                    <p class="text-center text-red-500">{{ $errors->first('images') }}</p>
                    @endif 
                    </div>

                    <div class="grid grid-cols-2 gap-2 w-full">
                        <button type="submit" class="bg-green-800 text-white font-bold p-2 mt-5">
                            Submit
                        </button>
                        <a href="{{url()->previous()}}" class="bg-gray-800 text-white font-bold p-2 mt-5 text-center" role="button">Cancel</a>
                        </div>
                </div>
            </form>
        </div>
@endsection