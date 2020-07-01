@extends('layouts.app')

@section('title'){{$data['name']}} @endsection

@section('content')
  <div class="flex flex-col justify-center items-center h-auto bg-fixed" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
      <div class="mt-6 w-full px-4 md:w-2/3">
        <h2 class="text-2xl md:text-4xl text-white self-center">{{$data['name']}}</h2>
        <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
          <img src="{{$data['image']}}" alt="{{$data['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
          <div class="py-4 px-4 pr-8">
            <h6 class="md:text-base text-sm" >Was created in {{$data['creationDate']}}</h6>
            <h6 class="md:text-base text-sm" >First album was released in {{$data['firstAlbum'][0].$data['firstAlbum'][1].".".$data['firstAlbum'][3].$data['firstAlbum'][4].".".$data['firstAlbum'][6].$data['firstAlbum'][7]}} </h6>
            <h6 class="md:text-base text-sm font-bold">Members:</h6>
            <h6 class="md:text-base text-sm">
            @for ($i = 0; $i < sizeof($data['members']); $i++)
              {{$data['members'][$i]}}
              @if($i!=sizeof($data['members'])-1)
                ,
              @endif
            @endfor
            </h6>
          </div>
        </div>
      </div>
    <table class="table-auto border-collapse w-1/2 bg-white my-8 rounded-lg">
    <thead>
      <tr class="text-sm font-medium text-left" style="font-size: 0.9674rem">
        <th class="px-4 py-2">Location</th>
        <th class="px-4 py-2">Date</th>
      </tr>
    </thead>
    <tbody class="text-sm font-normal">
      @foreach ($data['datesLocations'] as $key => $value)
        @foreach ($value as $date)
          <tr>
            <td class="border-t-2 border-black px-4 py-4">{{ ucwords(strtok($key, '-')) }}, {{ ucwords(substr($key, strpos($key, "-") + 1) ) }}</td>
            <td class="border-t-2 border-black px-4 py-4">{{$date[0].$date[1].".".$date[3].$date[4].".".$date[6].$date[7]}}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>
  </div>
@endsection
