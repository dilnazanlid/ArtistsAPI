@extends('layouts.app')

@section('title')Artists @endsection

@section('content')
  <div class="bg-gray-900 h-auto pb-8" style=" background-size: 100% 100%;">
    <div class="flex flex-col md:flex-row justify-between items-center lg:mx-40 mx-20">
      <div class="container mt-5 ml-8">
        <button type="button" name="filter" id="filter" class="px-4 py-4 bg-gray-800 rounded-full focus:outline-none">
          <img src="https://img.icons8.com/android/24/000000/filter.png" class="w-6 h-6"/>
        </button>
      </div>
      <livewire:search-dropdown>
    </div>
    <div class="flex flex-col items-center" id="filterSettings" style="display:none;">
      <form class="shadow-md rounded mt-4 py-4 px-4 bg-gray-800" action="/artists" method="get">
        @csrf
        <label for="dateFrom" class="text-white mr-4 font-semibold">First album date <b>FROM:</b></label>
        <input type="date" name="dateFrom" id="dateFrom" value="{{ Request::input('dateFrom') }}" onchange="FromDateOverride()" placeholder="Date from" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500">
        <label for="dateTo" class="text-white mx-4 font-semibold">First album date <b>TO:</b></label>
        <input type="date" name="dateTo" id="dateTo" placeholder="Date to" value="{{ Request::input('dateTo') }}" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500">
        <br>
        <label for="creationDate" class="text-white font-semibold">Creation year: </label>
        <input type="number" name="creationDate" id="creationDate" placeholder="ex. 1973" value="{{ Request::input('creationDate') }}" min="1950" class="focus:outline-none shadow appearance-none border-2 rounded-full my-2 py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500">
        <br>
        <label for="memberNumber" class="text-white font-semibold">Members in the band:</label>
          @foreach($data[0] as $key)
            <input type="checkbox" name="memberNumber[]" value="{{$key}}" {{in_array($key, $data[3]) ? 'checked' : ''}} class="shadow border-2 rounded-full my-2 mx-2 w-2 text-gray-700">{{$key}}
          @endforeach
        <br>
        <div class="flex">
          <label for="location" class="text-white font-semibold my-4">Locations: </label>
          <select class="location block shadow appearance-none border-2 w-64 my-2 mx-2 px-2 rounded-full leading-tight focus:outline-none focus:border-gray-500" name="location">
            @if(Request::input('location')!='null' || Request::has('location'))
              <option value="{{Request::input('location')}}">{{Request::input('location')}}</option>
            @else
              <option value="null">Select country</option>
            @endif
            @foreach($data[2] as $key=>$value)
              <option value="{{$value}}">{{$value}}</option>
            @endforeach
          </select>
        </div>
        <br>
        <div class="flex flex-row justify-center items-center">
          <input type="submit" name="filteringData" value="Filter" class="focus:outline-none shadow appearance-none border-2 rounded-full my-4 mx-4 py-2 px-3 w-32 text-gray-700 leading-tight text-black focus:border-gray-500 hover:text-orange-500 font-bold">
          <a href="/artists"><button type="button" name="reset" class="focus:outline-none shadow appearance-none border-2 rounded-full my-4 mx-4 py-2 px-3 w-32 leading-tight text-white focus:border-gray-500 hover:text-orange-500 font-bold">Reset</button></a>
        </div>
      </form>
    </div>
    <div class="AllArtists">
      @if(sizeof($data[1])==0)
        <div class="flex justify-center items-center my-4">
          <h1 class="font-bold text-2xl text-white">No results found</h1>
        </div>
      @else
      <div class="flex flex-col lg:mx-40 mx-20 mt-4">
          <h1 class="text-white">{{sizeof($data[1])}} results found </h1>
      </div>
        @for ($i = 0; $i < sizeof($data[1]); $i++)
          <div class="flex flex-wrap justify-center items-center">
            <div class="mt-6 w-1/2 px-4 md:w-2/5">
              <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
                <img src="{{$data[1][$i]['image']}}" alt="{{$data[1][$i]['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
                <div class="py-4 px-4 pr-8">
                  <a href="{{route('artists-one', $data[1][$i]['id'])}}"><h4 class="md:text-2xl text-xl text-semibold text-black hover:text-orange-500">{{$data[1][$i]['name']}}</h4></a>
                  <h6 class="md:text-base text-sm" >Was created in {{$data[1][$i]['creationDate']}}</h6>
                  <h6 class="md:text-base text-sm" >First album was released in {{$data[1][$i]['firstAlbum']}} </h6>
                </div>
              </div>
            </div>
            @if($i!=sizeof($data[1])-1)
            <div class="mt-6 w-1/2 px-4 md:w-2/5">
              <div class="flex flex-col lg:flex-row items-center rounded-lg bg-white shadow-lg overflow-auto">
                <img src="{{$data[1][++$i]['image']}}" alt="{{$data[1][$i]['name']}}" class="md:flex-shrink-0 w-full sm:w-auto">
                <div class="py-4 px-4 pr-8">
                  <a href="{{route('artists-one', $data[1][$i]['id'])}}"><h4 class="md:text-2xl text-xl text-semibold  text-black hover:text-orange-500">{{$data[1][$i]['name']}}</h4></a>
                  <h6 class="md:text-base text-sm" >Was created in {{$data[1][$i]['creationDate']}}</h6>
                  <h6 class="md:text-base text-sm" >First album was released in {{$data[1][$i]['firstAlbum']}} </h6>
                </div>
              </div>
            </div>
            @endif
          </div>
        @endfor
      @endif
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script>
  function FromDateOverride(){
    var x =  document.getElementById("dateFrom").value;
    document.getElementById("dateTo").value = x;
  }

  $(document).ready(function(){

    $('button').click(function(){
      $('#filterSettings').toggle('slow');
    });

  });
  </script>
  <livewire:scripts>
@endsection
