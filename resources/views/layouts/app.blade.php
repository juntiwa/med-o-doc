<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - MED O-Doc</title>
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <!-- css -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/status.css') }}" rel="stylesheet">

   <!-- daisyui -->
   <link href="https://cdn.jsdelivr.net/npm/daisyui@2.17.0/dist/full.css" rel="stylesheet" type="text/css" />
   <script src="https://cdn.tailwindcss.com"></script>

   <!--  ajax -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
<body class="font-sarabun bg-white min-h-screen max-h-full text-lg text-slate-900">
@include('fonts/sarabun')
@section('sidebar')
   <div class="navbar bg-slate-100 sticky top-0 z-50">
      <div class="navbar-start  text-xl ">
         <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
               <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-slate-50 rounded-box w-52 ">
               <li class="@if (Route::is('documents')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('documents')}}">ค้นหาเอกสาร</a></li>
               <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 " tabindex="0">
                  <a class="justify-between">
                     จัดการระบบ
                     <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/>
                     </svg>
                  </a>
                  <ul class="p-2 bg-slate-100 text-lg">
                     <li class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
                     <li class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('manage.create')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
                     <li class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a></li>
                  </ul>
               </li>
            </ul>
         </div>
         <a class="btn btn-ghost normal-case text-xl">Med O-Doc</a>
      </div>
      <div class="navbar-center hidden lg:flex">
         <ul class="menu menu-horizontal p-0">
            <li class="@if (Route::is('documents')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('documents')}}">ค้นหาเอกสาร</a></li>
            <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 " tabindex="0">
               <a>
               จัดการระบบ
               <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24">
                  <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z"/>
               </svg>
               </a>
               <ul class="p-2 bg-slate-50 text-lg">
               <li class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a></li>
               <li class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('manage.create')}}">เพิ่มสิทธิ์ผู้ใช้งาน</a></li>
               <li class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "><a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a></li>
               </ul>
            </li>
         </ul>
      </div>
      <div class="navbar-end text-lg flex flex-col lg:flex-row items-end">
         <span class="lg:mr-2 md:mr-2 text-blue-700">
            <!-- ชื่อเข้าสู่ระบบ -->
            {{Auth::user()->full_name}}
         </span>
         <!-- Authentication -->
         <form method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button type="submit">
               <span class="text_logout">
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
</html>