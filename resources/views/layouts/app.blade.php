<!doctype html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - MED O-Doc</title>
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- unicons -->
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
   <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

   <!-- css -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/status.css') }}" rel="stylesheet">

   <!-- daisyui -->
   <link href="https://cdn.jsdelivr.net/npm/daisyui@2.14.3/dist/full.css" rel="stylesheet" type="text/css" />
   <script src="https://cdn.tailwindcss.com"></script>

   <!-- flowbite -->
   <link rel="stylesheet" href="https://unpkg.com/flowbite@1.4.5/dist/flowbite.min.css" />
   <script src="https://unpkg.com/flowbite@1.4.5/dist/flowbite.js"></script>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>

@include('fonts/sarabun')

<body class="font-sarabun bg-white min-h-screen max-h-full">
   @section('sidebar')
   <div class="navbar bg-slate-50 sticky top-0 z-50 ">
      <div class="navbar-start">
         <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
               </svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52 bg-slate-50">
               <li class="@if (Route::is('docShow') || Route::is('reg.search')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                  hover:text-teal-500 font-medium">
                  <a href="{{route('docShow')}}">ค้นหาเอกสาร</a>
               </li>
               @if (Auth::user()->is_admin == "1")
               <li tabindex="0">
                  <a class="justify-between @if (Route::is('permission')||Route::is('addPermis')) text-teal-500 text-shadow-sm  @else 
                  text-slate-600 @endif hover:text-teal-500 font-medium">
                     จัดการระบบ
                     <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                     </svg>
                  </a>
                  <ul class="p-2 bg-slate-50 shadow-md">
                     <li class="@if (Route::is('activitylog')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('activitylog')}}">Activity log</a>
                  </li>
                  <li class="@if (Route::is('permission')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('permission')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
                  <li class="@if (Route::is('addPermis')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('addPermis')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
                  </ul>
               </li>
               @endif
            </ul>
         </div>
         @if (Auth::user()->is_admin == "1")
         <a href="{{route('activitylog')}}" class="btn btn-ghost normal-case text-xl text-slate-900">MED O-Doc</a>
         @else
         <a href="{{route('docShow')}}" class="btn btn-ghost normal-case text-xl text-slate-900">MED O-Doc</a>
         @endif
      </div>
      <div class="navbar-center hidden lg:flex ">
         <ul class="menu menu-horizontal p-0">
            <li class="@if (Route::is('docShow') || Route::is('reg.search')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
            hover:text-teal-500 font-medium">
               <a href="{{route('docShow')}}">ค้นหาเอกสาร</a>
            </li>
            @if (Auth::user()->is_admin == "1")
            
            <li tabindex="0">
               <a class="@if (Route::is('permission')||Route::is('addPermis')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
               hover:text-teal-500 font-medium">
                  จัดการระบบ
                  <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                     viewBox="0 0 24 24">
                     <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                  </svg>
               </a>
               <ul class="p-2 bg-slate-50 shadow-md">
                  <li class="@if (Route::is('activitylog')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('activitylog')}}">Activity log</a>
                  </li>
                  <li class="@if (Route::is('permission')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('permission')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
                  <li class="@if (Route::is('addPermis')) text-teal-500 text-shadow-sm  @else text-slate-600 @endif 
                     hover:text-teal-500 font-medium">
                     <a href="{{route('addPermis')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
               </ul>
            </li>
            @endif
            
         </ul>
      </div>
            
      <div class="navbar-end">
         <span class="lg:mr-2 md:mr-2 text-blue-700 text-base">
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

   @show

   <div class="lg:p-6 p-3 max-h-full">
      @yield('content')
   </div>
</body>
<!-- search type -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
   integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
   integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
   crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
   $.ajaxSetup({
      headers: {
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
   });
</script>
</html>