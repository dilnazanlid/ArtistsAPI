<div class="relative mt-2 md:mt-0">
  <form class="shadow-md rounded mt-4" action="/search" method="get">
    <div class="flex flex-row">
      <input wire:model.debounce.500ms="searchHint" class="shadow appearance-none border-2 rounded-l-full py-2 px-3 w-64 text-gray-700 leading-tight focus:border-gray-500 focus:outline-none" id="searchHint" name="searchHint" type="text" autocomplete="off" placeholder="Search for">
      <input class="shadow appearance-none border-2 rounded-r-full py-2 px-3 bg-gray-800 text-white font-semibold  hover:bg-orange-500" type="submit" name="search" value="Search">
    </div>
    @if ($errors->any())
      <div class="flex text-center mt-4 justify-center items-center">
          <ul>
              @foreach ($errors->all() as $error)
                  <li class="bg-red-200 py-2 px-2 rounded">{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
  </form>
  <div wire:loading class="spinner top-0 right-0 mt-8 mr-24"></div>
  @if(strlen($searchHint) >= 2)
    <div class="absolute bg-gray-800 rounded w-full mt-2 text-white">
      @if($data->count() > 0)
        <ul>
          @foreach ($data as $key => $value)
            <li class="border-b border-gray-700">
              @if($value[2]=='country' || $value[2]=='city')
                <a href="{{route('location-one', [$value[2], $value[1]])}}" class="block hover:bg-gray-700 px-3 py-3 text-sm">{{ $value[1] }} | {{$value[3]}}</a>
              @else
                <a href="{{route('artists-one', $value[0]+1)}}" class="block hover:bg-gray-700 px-3 py-3 text-sm">{{ $value[1] }} | {{$value[3]}}</a>
              @endif
            </li>
          @endforeach
        </ul>
      @else
        <div class="px-3 py-3">
          No result for "{{$searchHint}}"
        </div>
      @endif
    </div>
  @else
    <div></div>
  @endif
</div>
