@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
  <div class="bg-gray-900">
    <div class="text-center">
      <h2 class="pt-4 lg:text-4xl md:text-2xl text-xl text-bold text-white">Choose an artist</h2>
    </div>
    @for ($i = 0; $i < sizeof($data); $i++)
      <div class="flex flex-wrap justify-center items-center">
        <div class="mt-6 w-1/2 px-4 md:w-2/5">
          <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
            <img src="{{$data[$i]['image']}}" alt="{{$data[$i]['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
            <div class="py-4 px-4 pr-8">
              <a href="{{route('artists-one', $data[$i]['id'])}}"><h4 class="md:text-2xl text-xl text-semibold text-black hover:text-orange-500">{{$data[$i]['name']}}</h4></a>
              <h6 class="md:text-base text-sm" >Was created in {{$data[$i]['creationDate']}}</h6>
              <h6 class="md:text-base text-sm" >First album was released in {{$data[$i]['firstAlbum'][0].$data[$i]['firstAlbum'][1].".".$data[$i]['firstAlbum'][3].$data[$i]['firstAlbum'][4].".".$data[$i]['firstAlbum'][6].$data[$i]['firstAlbum'][7]}} </h6>
            </div>
          </div>
        </div>
        <div class="mt-6 w-1/2 px-4 md:w-2/5">
          <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
            <img src="{{$data[++$i]['image']}}" alt="{{$data[$i]['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
            <div class="py-4 px-4 pr-8">
              <a href="{{route('artists-one', $data[$i]['id'])}}"><h4 class="md:text-2xl text-xl text-semibold  text-black hover:text-orange-500">{{$data[$i]['name']}}</h4></a>
              <h6 class="md:text-base text-sm" >Was created in {{$data[$i]['creationDate']}}</h6>
              <h6 class="md:text-base text-sm" >First album was released in {{$data[$i]['firstAlbum'][0].$data[$i]['firstAlbum'][1].".".$data[$i]['firstAlbum'][3].$data[$i]['firstAlbum'][4].".".$data[$i]['firstAlbum'][6].$data[$i]['firstAlbum'][7]}} </h6>
            </div>
          </div>
        </div>
      </div>
    @endfor
  </div>
@endsection
