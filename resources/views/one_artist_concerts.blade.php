@extends('layouts.app')

@section('title')Concerts @endsection

@section('content')
    <div class="flex justify-center h-auto bg-fixed" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
    <table class="table-auto border-collapse w-1/2 bg-white my-8 rounded-lg">
    <thead>
      <tr class="text-sm font-medium text-left" style="font-size: 0.9674rem">
        <th class="px-4 py-2">Location</th>
        <th class="px-4 py-2">Date</th>
      </tr>
    </thead>
    <tbody class="text-sm font-normal">
      @foreach ($data as $key => $value)
        @foreach ($value as $date)
          <tr>
            <td class="border-t-2 border-orange-500 px-4 py-4">{{ ucwords(strtok($key, '-')) }}, {{ ucwords(substr($key, strpos($key, "-") + 1) ) }}</td>
            <td class="border-t-2 border-orange-500 px-4 py-4">{{$date[0].$date[1].".".$date[3].$date[4].".".$date[6].$date[7]}}</td>
          </tr>
        @endforeach
      @endforeach
    </tbody>
  </table>
  </div>
@endsection
