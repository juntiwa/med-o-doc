@extends('layouts.guest')
@section('content')
<div class="flex items-center justify-center h-screen bg-blue-100">
   <form action="{{ route('checklogin') }}" method="POST">
      @csrf
      <div class="bg-white rounded-2xl border shadow-x1 p-10 max-w-lg">
         <div class="flex flex-col items-center space-y-4">
            <img src="{{asset('images\search.png')}}" class=" w-28" alt="">
            <h1 class="font-bold lg:text-2xl text-xl text-gray-700 w-5/6 md:w-screen lg:w-screen text-center">
               ระบบค้นหาเอกสารเก่า
            </h1>
            @error('message')
            <p class="text-base text-red-500 text-center w-5/6">
               {{ $message }}
            </p>
            @enderror

            <input type="text" name="username" placeholder="ชื่อ.นามสกุล 3 ตัว" id="username" class="border-2 rounded-lg w-full 
            h-12 px-4" value="{{ old('username') }}" required autocomplete="username" autofocus />

            <input type="password" name="password" placeholder="Password" id="password" class="border-2 rounded-lg w-full h-12 
            px-4" required />
            <button type="submit" class="bg-red-500 text-white rounded-md hover:bg-red-600 font-semibold px-4 py-3 w-full">
               เข้าสู่ระบบ
            </button>
         </div>
      </div>
   </form>
</div>
@endsection