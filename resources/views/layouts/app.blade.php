<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - MED O-Doc</title>
    <link rel="icon" href="{{ asset('images/search.png') }}" type="image/x-icon">

    <!-- css -->
    <link href="{{ asset(mix('css/app.css')) }}" rel="stylesheet">

    <!--  ajax -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

</head>
@include('fonts/sarabun')

<body class="font-sarabun bg-white min-h-screen max-h-full text-lg text-slate-900">
    @section('sidebar')
        <div class="navbar bg-slate-100 sticky top-0 z-50 text-base">
            <div class="navbar-start text-lg">
                <div class="dropdown">
                  @if (Auth::user()->is_admin == 1)
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h8m-8 6h16" />
                        </svg>
                    </label>
                    
                        <ul tabindex="0"
                            class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-slate-50 rounded-box w-52 text-lg">
                            <li
                                class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{ route('documents') }}">ค้นหาเอกสาร</a>
                            </li>
                            <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "
                                tabindex="0">
                                <a class="justify-between">
                                    จัดการระบบ
                                    <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24"
                                        height="24" viewBox="0 0 24 24">
                                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                                    </svg>
                                </a>
                                <ul class="p-2 bg-slate-100 text-lg">
                                    <li
                                        class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                        <a href="{{ route('manages') }}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                                    </li>
                                    <li
                                        class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                        <a href="{{ route('manage.create') }}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                                    </li>
                                    <li
                                        class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                        <a href="{{ route('logactivitys') }}">ประวัติการใช้งาน</a>
                                    </li>
                                </ul>
                            </li>
                            <li
                                class="@if (Route::is('announces')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{ route('announces') }}">เพิ่มข่าวประกาศ</a>
                            </li>

                        </ul>
                    @endif
                </div>
                <a href="{{ route('documents') }}" class="btn btn-ghost normal-case text-lg">MED O-Doc</a>
                @if (Auth::user()->is_admin == 1)
                    <ul class="menu menu-horizontal hidden lg:flex p-0 text-lg">
                        <li
                            class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{ route('documents') }}">ค้นหาเอกสาร</a>
                        </li>

                        <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "
                            tabindex="0">
                            <a>
                                จัดการระบบ
                                <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                    viewBox="0 0 24 24">
                                    <path d="M7.41,8.58L12,13.17L16.59,8.58L18,10L12,16L6,10L7.41,8.58Z" />
                                </svg>
                            </a>
                            <ul class="p-2 bg-slate-50 ">
                                <li
                                    class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                    <a href="{{ route('manages') }}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                                </li>
                                <li
                                    class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                    <a href="{{ route('manage.create') }}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                                </li>
                                <li
                                    class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                    <a href="{{ route('logactivitys') }}">ประวัติการใช้งาน</a>
                                </li>
                            </ul>
                        </li>

                        <li
                            class="@if (Route::is('announces')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{ route('announces') }}">เพิ่มข่าวประกาศ</a>
                        </li>
                    </ul>
                @endif
            </div>
            {{-- <div class="navbar-center hidden lg:flex">

        </div> --}}
            <div class="navbar-end text-lg flex flex-col items-end ">

                <div class="flex flex-row">
                    <span class="lg:mr-2 md:mr-2 ">
                        <!-- ชื่อเข้าสู่ระบบ -->
                        {{ Auth::user()->full_name }}
                    </span>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button id="logout" type="submit" class="flex">
                            <span class="text-red-600 hover:text-teal-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class=" w-6 fill-red-400 hover:fill-teal-400 ml-1"
                                    viewBox="0 0 512 512">
                                    <path
                                        d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z" />
                                </svg>
                            </span>
                        </button>
                    </form>
                </div>
                {{-- รหัสผ่านจะหมดอีกใน {{session()->get('expires')}} วัน --}}
            </div>
        </div>
    @show
    <div class="lg:p-6 p-3 max-h-full">
        @yield('content')
    </div>
    <script type="text/javascript" src="{{ asset(mix('js/setformdoc.js')) }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('#logout').click(function(event) {
            var form = $(this).closest("form");
            var name = $(this).data("name");
            event.preventDefault();
            swal({
                    title: `คุณต้องการออกจากระบบหรือไม่ ?`,
                    text: "กดปุ่มตกลง หากต้องการออกจากระบบ",
                    icon: "warning",
                    buttons: {
                        confirm: "ตกลง",
                        cancel: "ยกเลิก",
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
</body>

</html>
