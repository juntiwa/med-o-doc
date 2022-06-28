<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">
   <title>@yield('title') - MED O-Doc</title>

   <!-- css -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

@include('fonts/k2d')
<body class="font-k2d">
   @section('sidebar')
   <!-- This is the master sidebar. -->
   @show
   
   <div class="text-gray-900 antialiased">
      @yield('content')

   </div>
  
</body>
</html>