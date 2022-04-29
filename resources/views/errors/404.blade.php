<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>404 - Not found</title>
   <!-- Styles -->
   <link rel="stylesheet" href="{{asset('css/app.css')}}">
   <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">

   <!-- icon -->
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>
</head>
@include('fonts/k2d')

<body class="font-k2d">
   <div class="flex h-screen justify-center items-center bg-slate-200">
      <div class="text-center">
         <p class=" text-red-500 text-3xl font-semibold">ไม่พบไฟล์เอกสาร</p>
         <img src="{{asset('images/error-404.png')}}" class="h-96" alt="">
      </div>
   </div>
</body>

</html>