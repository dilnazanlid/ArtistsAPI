@extends('layouts.app')

@section('title'){{$data['name']}} @endsection

@section('content')
  <div class="h-screen" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
    <div class="flex flex-wrap justify-center items-center">
      <div class="mt-6 w-1/2 px-4 md:w-2/5">
        <h2 class="text-2xl md:text-4xl text-white self-center">{{$data['name']}}</h2>
        <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
          <img src="{{$data['image']}}" alt="{{$data['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
          <div class="py-4 px-4 pr-8">
            <h6 class="md:text-base text-sm" >Was created in {{$data['creationDate']}}</h6>
            <h6 class="md:text-base text-sm" >First album was released in {{$data['firstAlbum'][0].$data['firstAlbum'][1].".".$data['firstAlbum'][3].$data['firstAlbum'][4].".".$data['firstAlbum'][6].$data['firstAlbum'][7]}} </h6>
          </div>
        </div>
        <div class="flex justify-center items-center">
          <button type="button" name="concerts" class="my-4 mx-auto py-4 px-4 rounded-lg text-black hover:text-orange-500 font-bold text-2xl"  style="background-color: #1d1d1f;"><a href="{{route('artists-concerts', $data['id'])}}">See schedule</a></button>
        </div>
      </div>
    </div>
@endsection
