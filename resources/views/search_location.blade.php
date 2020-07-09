@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
    <div class="flex flex-col justify-center items-center h-auto bg-fixed" style="background-image: url('https://free4kwallpapers.com/uploads/originals/2019/07/02/road-marking-cloudy-wallpaper.jpg'); background-size: 100% 100%;">
      <table class="table-auto border-collapse w-1/2 bg-white my-8 rounded-lg" style="background-color: #1d1d1f;">
      <thead>
        <tr class="text-sm font-medium text-left">
          <th class="px-4 py-2 text-white flex items-center">Band/Artist with concert in <h1 class=" ml-2 text-orange-500 text-xl">{{$data[0]}}</h1></th>
        </tr>
      </thead>
      <tbody class="text-sm font-normal font-bold text-xl">
        @foreach ($data[1] as $key => $value)
          <tr>
            <td class="border-t-2 border-black px-4 py-4"><a href="{{route('artists-one', $value[0])}}">{{ $value[1] }}</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection
