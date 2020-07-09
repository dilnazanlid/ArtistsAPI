@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
    <div class="flex flex-col justify-center items-center h-auto bg-fixed" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
      <table class="table-auto border-collapse w-1/2 bg-white my-8 rounded-lg">
      <thead>
        <tr class="text-sm font-medium text-left" style="font-size: 0.9674rem">
          <th class="px-4 py-2">Search match</th>
          <th class="px-4 py-2">Description</th>
        </tr>
      </thead>
      <tbody class="text-sm font-normal">
        @foreach ($data as $key => $value)
          <tr>
            @if($value[2]=='country' || $value[2]=='city')
              <td class="border-t-2 border-black px-4 py-4"> <a href="{{route('location-one', [$value[2], $value[1]])}}" class="text-black font-bold">{{ $value[1] }}</a></td>
              <td class="border-t-2 border-black px-4 py-4">{{ $value[3] }}</td>
            @else
              <td class="border-t-2 border-black px-4 py-4"> <a href="{{route('artists-one', $value[0]+1)}}" class="text-black font-bold">{{ $value[1] }}</a></td>
              <td class="border-t-2 border-black px-4 py-4">{{ $value[3] }}</td>
            @endif
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
