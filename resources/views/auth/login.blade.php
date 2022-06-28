<!-- resources/views/child.blade.php -->
 
@extends('layouts.guest')
 
@section('title', 'เข้าสู่ระบบ')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
<!-- Section 1 -->
<section class="flex justify-center items-center w-full h-screen px-8 py-16 bg-gray-100 xl:px-8">
   <div class="max-w-6xl mx-auto">
      <div class="flex flex-col items-center md:flex-row ">
         <div class="w-full space-y-5 md:w-3/5 md:pr-16 hidden md:block lg:block">
            <p class="font-medium text-base text-green-400 uppercase">MED O-Doc</p>
            <h2 class="text-xl font-extrabold text-black sm:text-2xl md:text-4xl leading-loose">
               ค้นหาเอกสารเก่า ภาควิชาอายุรศาสตร์
            </h2>
            <p class="text-lg text-gray-600 md:pr-16">
               หากพบปัญหาในการใช้งาน ติดต่อหน่วยเวชสารสนเทศ ภาควิชาอายุรศาสตร์ โทร. 02-4198260 (ในเวลาราชการ) </p>
         </div>

         <div class="w-full mt-16 md:mt-0 md:w-2/5">
            <form action="{{ route('login.authenticate') }}" method="POST">
               @csrf
               <div class="relative z-10 h-auto p-8 py-10 overflow-hidden bg-white border-b-2 border-gray-300 shadow-2xl px-7 rounded
                        flex flex-col justify-center items-center">
                  <img src="{{asset('images\search.png')}}" class="w-20" alt="">
                  <h3 class="mb-6 text-2xl font-medium text-center">ระบบค้นหาเอกสารเก่า</h3>
                  @error('message')
                  <p class="text-base text-red-500 text-center w-5/6 mb-3">
                     {{ $message }}
                  </p>
                  @enderror
                  <input type="text" name="username" id="username" class="block w-full px-4 py-3 mb-4 border-2 border-gray-200 
                     focus:ring focus:ring-green-400 focus:outline-none rounded" placeholder="ชื่อ . นามสกุล 3 ตัว" value="{{ old('username') }}" required>
                  <input type="password" name="password" id="password" class="block w-full px-4 py-3 mb-4 border-2 border-gray-200 
                     focus:ring focus:ring-green-400 focus:outline-none rounded" placeholder="Password" required>

                  <button type="submit" class="w-full px-4 py-3 font-medium text-white bg-green-400 rounded">เข้าสู่ระบบ</button>
               </div>
            </form>
         </div>

      </div>
   </div>
</section>
@endsection