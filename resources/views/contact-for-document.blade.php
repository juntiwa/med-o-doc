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
       {{--  <p class="text-6xl text-blue-800 font-bold font-k2d pb-7 text-shadow-md">404</p>--}}
        <p class="text-4xl text-gray-800 font-sarabun pb-6 text-shadow-md">ต้องการเอกสารแนบ</p>
        <p class="text-2xl text-center text-gray-700 font-sarabun w-3/5 leading-loose pb-3">
            ติดต่อขอไฟล์ได้ที่ <span class="text-red-500">หน่วยเวชสารสนเทศ ภาควิชาอายุรศาสตร์ โทร. 02-4198260 (ในเวลาราชการ)</span>
        </p>
        <a href="{{ route('documents') }}" class="pb-12 font-sarabun text-xl text-blue-800
      hover:text-red-500 hover:text-shadow-md">กลับสู่หน้าหลัก</a>

        <img class=" h-64" src="{{asset('images/contact.png')}}" alt="">
    </div>

</body>

</html>
