<!doctype html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>@yield('title') - ระบบค้นหาเอกสารเก่า</title>
   <link rel="icon" href="{{asset('images/search.png')}}" type="image/x-icon">

   <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.0.1/tailwind.min.css'>

   <!-- Favicon -->
   <link rel="stylesheet" href="{{ asset('assets/css/backend.css?v=1.0.0')}}">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/thinline.css">
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/solid.css">
   <script src="https://unicons.iconscout.com/release/v4.0.0/script/monochrome/bundle.js"></script>
   <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">
   <link href="{{ asset('css/status.css') }}" rel="stylesheet">

   <!-- tailwind flowbite -->
   <script src="https://unpkg.com/flowbite@1.4.2/dist/flowbite.js"></script>

   <!-- Script ajax -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
</head>
@include('fonts/sarabun')

<body class="font-sarabun">
   <!-- Wrapper Start -->
   @section('sidebar')
   <div class="wrapper">
      <div class="iq-sidebar sidebar-default border-r-2 shadow-sm ">
         <div class="iq-sidebar-logo d-flex align-items-center justify-content-between">
            <img src="{{ asset('images/search.png')}}" class="img-fluid light-logo" alt="logo">
            <h5 class="logo-title light-logo ml-3">MED DMS</h5>
            <div class="iq-menu-bt-sidebar ml-0">
               <!-- <i class="las la-bars wrapper-menu"></i> -->
               <i class="uil uil-bars wrapper-menu"></i>
            </div>
         </div>
         <div class="data-scrollbar" data-scroll="1">
            <nav class="iq-sidebar-menu">
               <ul id="iq-sidebar-toggle" class="iq-menu">
                  @if (Auth::user()->is_admin == "1")
                  <li class="@if (Route::is('activitylog')) active @else  @endif">
                     <a href="{{route('activitylog')}}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-list">
                           <line x1="8" y1="6" x2="21" y2="6"></line>
                           <line x1="8" y1="12" x2="21" y2="12"></line>
                           <line x1="8" y1="18" x2="21" y2="18"></line>
                           <line x1="3" y1="6" x2="3" y2="6"></line>
                           <line x1="3" y1="12" x2="3" y2="12"></line>
                           <line x1="3" y1="18" x2="3" y2="18"></line>
                        </svg>
                        <span class="ml-4">Activity Log</span>
                     </a>
                  </li>
                  <li class=" ">
                     <a href="#product" class=" collapsed" data-toggle="collapse" aria-expanded="false">
                        <svg class="svg-icon" id="p-dash17" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                           <line x1="12" y1="9" x2="12" y2="13"></line>
                           <line x1="12" y1="17" x2="12.01" y2="17"></line>
                        </svg>
                        <span class="ml-4">สิทธิ์การเข้าถึงระบบ</span>
                        <svg class="svg-icon iq-arrow-right arrow-active" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                           <polyline points="10 15 15 20 20 15"></polyline>
                           <path d="M4 4h7a4 4 0 0 1 4 4v12"></path>
                        </svg>
                     </a>
                     <ul id="product" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle">
                        <li class=" @if (Route::is('permission')) active @else @endif">
                           <a href="{{route('permission')}}">
                              <i class="las la-minus"></i><span>ข้อมูลสิทธิ์ผู้ใช้งาน</span>
                           </a>
                        </li>
                        <li class="@if (Route::is('addPermis')) active @else @endif">
                           <a href="{{route('addPermis')}}">
                              <i class="las la-minus"></i><span>Add member</span>
                           </a>
                        </li>
                     </ul>
                  </li>
                  @endif
                  <li class="@if (Route::is('reg.show')||Route::is('reg.search')) active @else  @endif">
                     <a href="{{route('reg.show')}}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                           <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                           <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                        </svg>
                        <span class="ml-4">ลงทะเบียนส่งหนังสือ</span>
                     </a>
                  </li>
                  <li class="@if (Route::is('send.show')||Route::is('send.search')) active @else  @endif">
                     <a href="{{route('send.show')}}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-upload">
                           <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                           <polyline points="17 8 12 3 7 8"></polyline>
                           <line x1="12" y1="3" x2="12" y2="15"></line>
                        </svg>
                        <span class="ml-4">ทะเบียนหนังสือส่ง</span>
                     </a>
                  </li>
                  <li class="@if (Route::is('rec.show')||Route::is('rec.search')) active @else  @endif">
                     <a href="{{route('rec.show')}}">
                        <svg class="svg-icon" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download">
                           <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                           <polyline points="7 10 12 15 17 10"></polyline>
                           <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        <span class="ml-4">ทะเบียนหนังสือรับ</span>
                     </a>
                  </li>
               </ul>
            </nav>

            <div class="p-3"></div>
         </div>
      </div>
      <div class="iq-top-navbar border-b-2">
         <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
               <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
                  <!-- <i class="ri-menu-line wrapper-menu"></i> -->
                  <i class="uil uil-bars wrapper-menu"></i>
                  <a href="#" class="header-logo">
                     <img src="{{ asset('images/search.png')}}" class="img-fluid rounded-normal" alt="logo">
                     <h5 class="logo-title ml-3 font-medium text-base">MED DMS</h5>
                  </a>
               </div>
               <div class="d-flex align-items-center ">
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
            </nav>
         </div>
      </div>

      <div class="content-page">
         <div class="container-fluid">
            @yield('content')
            <!-- Page end  -->
         </div>
      </div>
   </div>

   <!-- Backend Bundle JavaScript -->
   <script src="{{ asset('assets/js/backend-bundle.min.js')}}"></script>

   <!-- app JavaScript -->
   <script src="{{ asset('assets/js/app.js')}}"></script>

   <script>
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });
   </script>
</body>

</html>