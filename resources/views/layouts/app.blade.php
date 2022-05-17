<!doctype html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - ระบบค้นหาเอกสารเก่า</title>
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- unicons -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
   <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

   <!-- css -->
   <link href="{{ asset('css/font.css') }}" rel="stylesheet">
   <link href="{{ asset('css/status.css') }}" rel="stylesheet">

   <!-- daisyui -->
   <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />
   <script src="https://cdn.tailwindcss.com"></script>

   <!-- flowbite -->
   <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.5/dist/flowbite.min.css" />
   <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

   <!-- Script ajax -->
   <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

   <!-- toastr -->
   <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
   <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>

</head>

@include('fonts/sarabun')

<body class="font-sarabun bg-white">
   @section('sidebar')
   <div class="navbar bg-slate-50 sticky top-0 z-50 shadow-sm">
      <div class="navbar-start">
         <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
               </svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
               @if (Auth::user()->is_admin == "1")
               <li><a href="{{route('activitylog')}}">Activity log</a></li>
               <li tabindex="0">
                  <a class="justify-between">
                     สิทธิ์การเข้าถึง
                     <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                     </svg>
                  </a>
                  <ul class="p-2 ml-3 shadow bg-base-100 rounded-box ">
                     <li><a href="{{route('permission')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
                     <li><a href="{{route('addPermis')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
                  </ul>
               </li>
               @endif
               <li><a href="{{route('reg.show')}}">ลงทะเบียนส่งหนังสือ</a></li>
               <li><a href="{{route('send.show')}}">ทะเบียนหนังสือส่ง</a></li>
               <li><a href="{{route('rec.show')}}">ทะเบียนหนังสือรับ</a></li>
            </ul>
         </div>
         <a class="btn btn-ghost normal-case text-xl">MED O-Doc</a>
      </div>
      <div class="navbar-center hidden lg:flex">
         <ul class="menu menu-horizontal p-0">
            @if (Auth::user()->is_admin == "1")
            <li class="@if (Route::is('activitylog')) text-teal-500 text-shadow-sm  @else @endif font-medium"><a href="{{route('activitylog')}}">Activity log</a></li>
            <li tabindex="0">
               <a class="@if (Route::is('permission')||Route::is('addPermis')) text-teal-500 text-shadow-sm  @else  @endif font-medium">
                  สิทธิ์การเข้าถึง
                  <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                     <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                  </svg>
               </a>
               <ul class="p-2 mt-3 shadow bg-base-100 rounded-box ">
                  <li class="@if (Route::is('permission')) text-teal-500 text-shadow-sm  @else  @endif font-medium"><a href="{{route('permission')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
                  <li class="@if (Route::is('addPermis')) text-teal-500 text-shadow-sm  @else  @endif font-medium"><a href="{{route('addPermis')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
               </ul>
            </li>
            @endif
            <li class="@if (Route::is('reg.show') || Route::is('reg.search')) text-teal-500 text-shadow-sm  @else  @endif font-medium"><a href="{{route('reg.show')}}">ลงทะเบียนส่งหนังสือ</a></li>
            <li class="@if (Route::is('send.show') || Route::is('send.search')) text-teal-500 text-shadow-sm  @else  @endif font-medium"><a href="{{route('send.show')}}">ทะเบียนหนังสือส่ง</a></li>
            <li class="@if (Route::is('rec.show') || Route::is('rec.search')) text-teal-500 text-shadow-sm  @else  @endif font-medium"><a href="{{route('rec.show')}}">ทะเบียนหนังสือรับ</a></li>
         </ul>
      </div>
      <div class="navbar-end">
         <div class="relative flex flex-col items-end justify-end lg:flex-row" x-data="{ isOpen: false }">
            <span class="lg:mr-2 text-blue-700 text-base">
               <!-- ชื่อเข้าสู่ระบบ -->
               {{Auth::user()->full_name}}
            </span>
            <!-- Authentication -->
            <form method="POST" action="{{ route('logout') }}" x-data>
               @csrf
               <button type="submit">
                  <span class="text_logout text-base">
                     {{ __('[ออกจากระบบ]') }}
                  </span>
               </button>
            </form>
         </div>
      </div>
   </div>
   @show

   <div class="lg:p-6 p-3">
      @yield('content')
   </div>
</body>

<!-- search type -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
</script>

</html>