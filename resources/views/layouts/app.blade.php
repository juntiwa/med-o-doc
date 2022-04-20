<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - ระบบค้นหาเอกสารเก่า</title>

   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css'>

   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- element -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" />
   <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
   <script src="https://cdn.tailwindcss.com"></script>
   <script src="https://cdn.jsdelivr.net/npm/tw-elements/dist/js/index.min.js"></script>

   <!-- for paginate -->
   <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

   <!-- Boxicons -->
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>


   <!-- CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <link rel="stylesheet" href="{{asset('css/app.css')}}">

   <!-- sidenav -->
   <link rel="stylesheet" href="{{asset('css/styles.css')}}">

   <!-- tailwind flowbite -->
   <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>

   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
@include('fonts/sarabun')

<body class="font-sarabun">

   @section('sidebar')
   <nav class="h-screen">
      <div class="logo-name flex flex-col justify-center items-center">
         <div class="logo-image">
            <img src="images/search.png" alt="">
         </div>
         <span class="logo_name w-44 flex items-center justify-center text-lg md:text-lg sm:text-2xl font-semibold">ระบบลงทะเบียนหนังสือ</span>
      </div>

      <div class="menu-items">
         <ul class="nav-links text-base md:text-lg sm:text-xl">
            <li class="@if (Route::is('reg.show')||Route::is('reg.search')) bg-slate-200 @else  @endif hover:bg-slate-50 rounded-md">
               <a href="{{route('reg.show')}}">
                  <i class='bx bx-edit-alt'></i>
                  <span class="link-name">ลงทะเบียนส่งหนังสือ</span>
               </a>
            </li>
            <li class="@if (Route::is('send.show')||Route::is('send.search')) bg-slate-200 @else  @endif hover:bg-slate-50 rounded-md">
               <a href="{{route('send.show')}}">
                  <i class='bx bx-mail-send'></i>
                  <span class="link-name">ทะเบียนหนังสือส่ง</span>
               </a>
            </li>
            <li class="@if (Route::is('rec.show')||Route::is('rec.search')) bg-slate-200 @else  @endif hover:bg-slate-50 rounded-md">
               <a href="{{route('rec.show')}}">
                  <i class='bx bx-download'></i>
                  <span class="link-name">ทะเบียนหนังสือรับ</span>
               </a>
            </li>
         </ul>
         <!-- Sidebar footer -->
         <div class="logout-mode flex-shrink-0 max-h-14 mb-2 text-base md:text-lg sm:text-xl">
            <ul>
               <li class="hover:bg-slate-50 rounded-md">
                  <a href="{{route('logout')}}">
                     <i class='bx bx-log-out'></i>
                     <span class="link-name">ออกจากระบบ</span>
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <section class="dashboard ">
      <div class="top relative flex items-center justify-between space-x-3 lg:text-lg md:text-xl">
         <i class='bx bx-menu sidebar-toggle flex items-start justify-start'></i>
         <span class="p-2 lg:text-lg md:text-xl font-semibold uppercase lg:hidden">ค้นหาเอกสาร</span>

         <!-- avatar button -->
         <div class="relative flex flex-col items-end justify-end lg:flex-row" x-data="{ isOpen: false }">
            <span class="lg:mr-2 text-blue-700 ">
              
            </span>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
               @csrf
               <button type="submit" class="text-black hover:text-red-600 cursor-pointer">
                  {{ __('[ออกจากระบบ]') }}
               </button>
            </form>
         </div>
      </div>


      <div class="dash-content">
         <div class="overview">
            @yield('content')
         </div>
   </section>



</body>
<!-- partial -->
<script src="{{ asset('js/app.js') }}"></script>
<!-- sidenav -->
<script src="{{ asset('js/script.js') }}"></script>



</html>