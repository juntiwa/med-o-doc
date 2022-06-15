<!DOCTYPE html>
<html lang="en">

<head>
   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
@include('fonts/sarabun')
@include('fonts/k2d')

<body class=" bg-slate-200">
   <div class="container mx-auto flex flex-col justify-center items-center h-screen">
      <p class="text-6xl text-blue-800 font-bold font-k2d pb-7 text-shadow-md">500</p>
      <p class="text-4xl text-gray-800 font-k2d pb-6">Server Error</p>
      <p class="text-xl text-center text-gray-700 font-sarabun w-2/5 leading-loose pb-3">Server Error กรุณาติดต่อผู้ดูแลระบบ
         <span class="font-bold text-red-500">หน่วยเวชสารสนเทศ ภาควิชาอายุรศาสตร์ </span>
      </p>
      <a href="{{ route('docShow') }}" class="pb-12 font-sarabun text-xl text-blue-800 
      hover:text-red-500 hover:text-shadow-md">กลับสู่หน้าหลัก</a>

      <img class=" h-64" src="{{asset('images/500.png')}}" alt="">
   </div>

</body>

</html>