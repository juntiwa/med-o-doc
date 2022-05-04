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

   <!-- paginate -->
   <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

   <!-- Boxicons -->
   <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>

   <!-- unicons -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
   <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>

   <!-- CSS -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <link rel="stylesheet" href="{{asset('css/app.css')}}">

   <!-- sidenav -->
   <link rel="stylesheet" href="{{asset('css/styles.css')}}">

   <!-- daisyui -->
   <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />
   <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />

   <!-- tailwind flowbite -->
   <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>

   <!-- Script -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
@include('fonts/sarabun')

<body class="font-sarabun">
   @section('sidebar')
   <!-- side rigth bar -->
   <nav class="h-screen ">
      <div class="logo-name flex flex-col justify-center items-center">
         <div class="logo-image">
            <img src="images/search.png" alt="">
         </div>
         <span class="logo_name w-44 flex items-center justify-center text-lg md:text-lg sm:text-2xl font-semibold">ระบบลงทะเบียนหนังสือ</span>
      </div>
      <div class="menu-items">
         <ul class="nav-links text-base md:text-lg sm:text-xl">
            @if (Auth::user()->role_name == "ผู้ดูแลระบบ")
            <li class="@if (Route::is('activitylog')) bg-slate-200 @else  @endif hover:bg-slate-50 rounded-md">
               <a href="{{route('activitylog')}}">
                  <i class="fa-regular fa-rectangle-list"></i>
                  <span class="link-name">Activity Log</span>
               </a>
            </li>
            <li class="@if (Route::is('permission')) bg-slate-200 @else  @endif hover:bg-slate-50 rounded-md">
               <a href="{{route('permission')}}">
                  <i class="uil uil-file-check-alt"></i>
                  <span class="link-name">สิทธิ์การเข้าถึงระบบ</span>
               </a>
            </li>
            @endif
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
                  <form method="POST" action="{{ route('logout') }}" x-data>
                     @csrf
                     <button type="submit" class="text-black hover:text-red-600 cursor-pointer">
                        <a href="{{route('logout')}}">
                           <i class='bx bx-log-out'></i>
                           <span class="link-name">ออกจากระบบ</span>
                        </a>
                     </button>
                  </form>
               </li>
            </ul>
         </div>
      </div>
   </nav>
   <section class="dashboard ">
      <div class="top relative flex items-center justify-between space-x-3 text-lg border-b-2">
         <i class='bx bx-menu sidebar-toggle flex items-start justify-start'></i>
         <span class="p-2 text-xl font-semibold uppercase lg:hidden">ค้นหาเอกสาร</span>
         <!-- avatar button -->
         <div class="relative flex flex-col items-end justify-end lg:flex-row" x-data="{ isOpen: false }">
            <span class="lg:mr-2 text-blue-700 ">
               <!-- ชื่อเข้าสู่ระบบ -->
               {{Auth::user()->username}}
            </span>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
               @csrf
               <button type="submit">
                  <span class="text-black hover:text-red-600 cursor-pointer">
                     {{ __('[ออกจากระบบ]') }}
                  </span>
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

<script>
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
</script>

<script src="{{ asset('js/useCeckSesionTimeout.js') }}"></script>

</html>