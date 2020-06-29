@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
  <div class="h-screen w-full" style="background-image: url('public/back.jpg'); background-size: 100% 100%;">
    <div class="flex justify-center items-center">
      <a href="{{route('artists-all')}}" class="text-xl md:text-4xl font-black py-2 px-2 rounded-lg text-white pt-56 hover:text-black outline-none">See all artists</a>
    </div>
  </div>
@endsection
