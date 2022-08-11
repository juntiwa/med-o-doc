<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo Navbar</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.17.0/dist/full.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="navbar bg-slate-100 sticky top-0 z-50">
        <div class="navbar-start  text-xl ">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-slate-50 rounded-box w-52 ">
                    <li
                        class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                        <a href="{{route('documents')}}">ค้นหาเอกสาร</a>
                    </li>
                    @if(Auth::user()->is_admin == 1)
                    <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "
                        tabindex="0">
                        <a class="justify-between">
                            จัดการระบบ
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                            </svg>
                        </a>
                        <ul class="p-2 bg-slate-100 text-lg">
                            <li
                                class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                            </li>
                            <li
                                class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('manage.create')}}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                            </li>
                            <li
                                class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <a href="{{route('documents')}}" class="btn btn-ghost normal-case text-xl">Med O-Doc</a>

        </div>
        {{-- <div class="navbar-center hidden lg:flex">

        </div> --}}
        <div class="navbar-end text-lg flex flex-col lg:flex-row items-center">
            <ul class="menu menu-horizontal p-0 text-lg">
                <li
                    class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                    <a href="{{route('documents')}}">ค้นหาเอกสาร</a>
                </li>
                @if(Auth::user()->is_admin == 1)
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
                            <a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                        </li>
                        <li
                            class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{route('manage.create')}}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                        </li>
                        <li
                            class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
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

    <div class="h-52"></div>
    <div class="navbar bg-slate-100 sticky top-0 z-50">
        <div class="navbar-start  text-xl ">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost lg:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-slate-50 rounded-box w-52 ">
                    <li
                        class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                        <a href="{{route('documents')}}">ค้นหาเอกสาร</a>
                    </li>
                    @if(Auth::user()->is_admin == 1)
                    <li class="@if (Route::is('manages') || Route::is('manage.create') || Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 "
                        tabindex="0">
                        <a class="justify-between">
                            จัดการระบบ
                            <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                viewBox="0 0 24 24">
                                <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z" />
                            </svg>
                        </a>
                        <ul class="p-2 bg-slate-100 text-lg">
                            <li
                                class="@if (Route::is('manages')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                            </li>
                            <li
                                class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('manage.create')}}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                            </li>
                            <li
                                class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                                <a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
            <a href="{{route('documents')}}" class="btn btn-ghost normal-case text-xl">Med O-Doc</a>
            <ul class="menu menu-horizontal p-0 text-lg">
                <li
                    class="@if (Route::is('documents') || Route::is('document.search') || Route::is('descriptions')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                    <a href="{{route('documents')}}">ค้นหาเอกสาร</a>
                </li>
                @if(Auth::user()->is_admin == 1)
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
                            <a href="{{route('manages')}}">ข้อมูลสิทธิ์ผู้ใช้งาน</a>
                        </li>
                        <li
                            class="@if (Route::is('manage.create')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{route('manage.create')}}">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</a>
                        </li>
                        <li
                            class="@if (Route::is('logactivitys')) text-sky-600 @else text-slate-700 @endif hover:text-rose-600 ">
                            <a href="{{route('logactivitys')}}">ประวัติการใช้งาน</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
        {{-- <div class="navbar-center hidden lg:flex">

        </div> --}}
        <div class="navbar-end text-lg flex flex-col lg:flex-row items-center">

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
</body>

</html>
