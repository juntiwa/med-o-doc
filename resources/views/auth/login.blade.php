@extends('layouts.guest')
@section('content')
<div class="flex items-center justify-center flex-col min-h-screen bg-gray-100">
   <div>
      <img src="{{asset('images\search.png')}}" class=" w-28" alt="">
   </div>

   <div class="sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg" style="width: 33%;">
      <h3 class="text-2xl mb-3 font-bold text-center">ระบบค้นหาเอกสารเก่า</h3>
      <form action="{{ route('checklogin') }}" method="POST">

         @csrf

         <label for="username" class="block font-medium text-base text-gray-700 pb-2">ชื่อผู้ใช้</label>
         <input type="text" name="username" placeholder="ชื่อ.นามสกุล 3 ตัว" id="username" class="form-control block w-full  px-3 py-1.5 text-base
               font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition  ease-in-out m-0
             focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" value="{{ old('username') }}" required autocomplete="username" autofocus>
         @error('username')
         <label class="text-red-500 font-medium text-base pt-2 pb-3">{{ $message }}</label>
         @enderror

         <label for="password" class="block font-medium text-base text-gray-700 pt-3 pb-2">รหัสผ่าน</label>
         <input type="password" name="password" placeholder="Password" id="password" class="form-control block w-full  px-3 py-1.5 text-base
               font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition  ease-in-out m-0
             focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" required >
         @error('password')
         <label class="text-red-500 font-medium text-base pt-2">{{ $message }}</label>
         @enderror

         <div class="flex items-center justify-end mt-4">
            <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-base leading-tight uppercase rounded shadow-md 
         hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition 
         duration-150 ease-in-out">เข้าสู่ระบบ</button>

         </div>

      </form>

   </div>
</div>
@endsection