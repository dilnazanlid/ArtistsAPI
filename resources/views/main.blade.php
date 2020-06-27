@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
  <div class="h-screen w-full" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
    <div class="flex justify-center items-center">
      <a href="{{route('artists-all')}}" class="text-xl md:text-4xl font-black py-2 px-2 rounded-lg text-white pt-56 hover:text-black outline-none">See all artists</a>
    </div>
  </div>
@endsection
