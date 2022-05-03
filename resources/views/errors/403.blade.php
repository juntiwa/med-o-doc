<!DOCTYPE html>
<html lang="en">

<head>
   <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
   <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
   <link rel="stylesheet" href="{{ asset('css/app.css')}}">
</head>
@include('fonts/sarabun')

<body class="font-sarabun">
   <div class="container mx-auto flex flex-col justify-center items-center h-screen">
      <p class="text-5xl text-blue-800">403</p>
      <p class="text-4xl text-blue-800">Access Denied</p>
      <p class="text-xl text-center text-blue-700">ขออภัยค่ะ คุณไม่มีสิทธิ์สำหรับการเข้าถึงระบบค้นหาเอกสารเก่า กรุณาติดต่อผู้ดูแลระบบ
      </p>
      <span class=" font-bold">ติดต่อหน่วยเวชสารสนเทศ ภาควิชาอายุรศาสตร์ </span>

      <img class=" h-96" src="{{asset('images/403.png')}}" alt="">
   </div>

</body>

</html>