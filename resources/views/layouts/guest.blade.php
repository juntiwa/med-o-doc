<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>@yield('title') ระบบค้นหาเอกสารเก่า</title>

   <!-- Styles -->
   <link rel="stylesheet" href="{{asset('css/app.css')}}">

   <!-- icon -->
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
</head>

@include('fonts/k2d')

<body class="font-k2d">
   <div class=" text-gray-900 antialiased">
      @yield('content')

   </div>
</body>

</html>