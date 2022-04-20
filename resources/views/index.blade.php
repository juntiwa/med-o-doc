@extends('layouts.app')

@section('title', 'Page Title')

@section('sidebar')
@parent

@endsection

@section('content')

<!-- Main content header -->
<div class="grid grid-rows-2 pb-5 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
   <div class="flex justify-between">
      <h1 class="text-3xl font-semibold whitespace-nowrap">หน้าหลัก</h1>

      <div class="flex justify-center">
         <div class="form-check form-switch">
            <input class="form-check-input appearance-none w-9 -ml-10 rounded-full float-left h-5 align-top bg-white bg-no-repeat bg-contain bg-gray-300 
            focus:outline-none cursor-pointer shadow-sm" type="checkbox" role="switch" id="switchshow" checked data-bs-toggle="collapse" data-bs-target=".multi-collapse" aria-expanded="true" aria-controls="multiCollapseExample1 multiCollapseExample2">
            <label class="form-check-label inline-block text-gray-800" id="labelswitch" for="switchshowDefault">ปิดจำนวนข้อมูล</label>
         </div>
      </div>

   </div>

   <nav class="flex" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-3">
         <li class="inline-flex items-center">
            <a href="{{route('index')}}" class="inline-flex items-center mt-4 text-md font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
               <svg class="mr-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
               </svg>
               หน้าหลัก
            </a>
         </li>
      </ol>
   </nav>
</div>


<!-- Start Content -->
<div class="grid grid-cols-1 gap-5 mt-6 sm:grid-cols-2 lg:grid-cols-3">
   <div>
      <div class="collapse multi-collapse show" id="multiCollapseExample1">
         <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
               <div class="flex flex-col space-y-2">
                  <span class="text-gray-400">ข้อมูลตารางลงทะเบียนหนังสือ</span>
                  <span class="text-lg font-semibold">{{$countreg}}</span>
               </div>
               <div>
                  <img class="w-max h-24 lg:w-max lg:h-24 rounded-md" src=" {{asset('images/reg.png')}}" alt="">
               </div>
            </div>
            <div>
               <!-- <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
               <span>from 2019</span> -->
            </div>
         </div>
      </div>
   </div>
   <div>
      <div class="collapse multi-collapse show" id="multiCollapseExample2">
         <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
               <div class="flex flex-col space-y-2">
                  <span class="text-gray-400">ข้อมูลตารางส่งหนังสือ</span>
                  <span class="text-lg font-semibold">{{$countsend}}</span>
               </div>
               <div>
                  <img class="w-max h-24 lg:w-max lg:h-24 rounded-md" src=" {{asset('images/send.png')}}" alt="">
               </div>
            </div>
            <div>
               <!-- <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
         <span>from 2019</span> -->
            </div>
         </div>
      </div>
   </div>
   <div>
      <div class="collapse multi-collapse show" id="multiCollapseExample2">
         <div class="p-4 transition-shadow border rounded-lg shadow-sm hover:shadow-lg">
            <div class="flex items-start justify-between">
               <div class="flex flex-col space-y-2">
                  <span class="text-gray-400">ข้อมูลตารางรับหนังสือ</span>
                  <span class="text-lg font-semibold">{{$countrec}}</span>
               </div>
               <div>
                  <img class="w-max h-24 lg:w-max lg:h-24 rounded-md" src=" {{asset('images/rec.png')}}" alt="">
               </div>
            </div>
            <div>
               <!-- <span class="inline-block px-2 text-sm text-white bg-green-300 rounded">14%</span>
         <span>from 2019</span> -->
            </div>
         </div>
      </div>
   </div>
</div>

<!-- tab info -->
<ul class="nav nav-tabs flex flex-col md:flex-row flex-wrap list-none border-b-0 pl-0 mb-4" id="tabs-tab3" role="tablist">
   <li class="nav-item" role="presentation">
      <a href="#tabs-regis" class="nav-link w-full block font-medium text-lg leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent
      px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent 
      active " id="tabs-home-tab3" data-bs-toggle="pill" data-bs-target="#tabs-regis" role="tab" aria-controls="tabs-regis" aria-selected="true">ลงทะเบียนหนังสือ</a>
   </li>
   <li class="nav-item" role="presentation">
      <a href="#tabs-send" class="nav-link w-full block font-medium text-lg leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent
      px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent" id="tabs-profile-tab3" data-bs-toggle="pill" data-bs-target="#tabs-send" role="tab" aria-controls="tabs-send" aria-selected="false">ส่งหนังสือ</a>
   </li>
   <li class="nav-item" role="presentation">
      <a href="#tabs-rec" class=" nav-link w-full block font-medium text-lg leading-tight uppercase border-x-0 border-t-0 border-b-2 border-transparent
      px-6 py-3 my-2 hover:border-transparent hover:bg-gray-100 focus:border-transparent " id="tabs-messages-tab3" data-bs-toggle="pill" data-bs-target="#tabs-rec" role="tab" aria-controls="tabs-rec" aria-selected="false">รับหนังสือ</a>
   </li>
</ul>
<div class="tab-content" id="tabs-tabContent3">
   <!-- regis -->
   <div class="tab-pane fade show active" id="tabs-regis" role="tabpanel" aria-labelledby="tabs-home-tab3">
      <h3 class="mt-6 mb-6 text-lg">ข้อมูลการลงทะเบียนหนังสือ</h3>

      <h1 class="text-red-500 text-center">กำลังดำเนินการแก้ไข</h1>


   </div>

   <!-- send -->
   <div class="tab-pane fade" id="tabs-send" role="tabpanel" aria-labelledby="tabs-profile-tab3">
      <h3 class="mt-6 text-lg">ข้อมูลการส่งหนังสือ</h3>
      <h1 class="text-red-500 text-center">กำลังดำเนินการแก้ไข</h1>



   </div>

   <!-- rec -->
   <div class="tab-pane fade" id="tabs-rec" role="tabpanel" aria-labelledby="tabs-profile-tab3">
      <h3 class="mt-6 text-lg">ข้อมูลการรับหนังสือ</h3>
      <h1 class="text-red-500 text-center">กำลังดำเนินการแก้ไข</h1>


   </div>
</div>

<script>
   $(document).on("click", "#switchshow", function() {
      var sw = $(this).hasClass("collapsed")
      var text = $("#labelswitch")
      if (sw === true) {
         text.text("แสดงจำนวนข้อมูล")
      } else {
         text.text("ปิดจำนวนข้อมูล")
      }
   })
</script>
@endsection