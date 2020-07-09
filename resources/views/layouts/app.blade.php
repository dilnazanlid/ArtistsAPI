<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <title>@yield('title')</title>
        <style media="screen">
        a{
          color:white;
        }
        a:hover{
          color:orange;
          text-decoration: none;
          cursor: pointer;
        }
        a:focus{
          outline:none;
        }
        p{
          color:white;
        }
        .spinner {
          position: absolute;
          color: transparent !important;
          pointer-events: none;
        }

        .spinner::after {
          content: '';
          position: absolute !important;
          top: calc(50% - (1em / 2));
          left: calc(50% - (1em / 2));
          display: block;
          width: 1em;
          height: 1em;
          border: 2px solid currentColor;
          border-radius: 9999px;
          border-right-color: black;
          border-top-color: black;
          animation: spinAround 500ms infinite linear;
        }

        @keyframes spinAround {
          from { transform: rotate(0deg); }
          to { transform: rotate(360deg); }
        }
        </style>
        <livewire:styles>
    </head>
    <body>
      <div class="flex py-4 justify-between items-center nav" style="background-color: #1d1d1f;">
        <a class="mx-4 font-bold text-xl" href="/">Artists API</a>
        <nav class="">
          <a class="pr-4" href="/">Home</a>
          <a class="pr-4" href="{{route('artists-all')}}">Artists</a>
          <a class="pr-4" href="#">About</a>
        </nav>
      </div>
      @yield('content')
    </body>
</html>
