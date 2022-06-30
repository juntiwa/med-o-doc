<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'ค้นหาเอกสาร')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
<section id="displayLogActivity">
   <div class="overflow-auto rounded-lg shadow-md hidden mt-6 lg:block">
      <table class="w-full">
         <thead class="bg-gray-100 border-b-2 border-gray-200">
        <tr>
          <th class="w-20 p-3 text-base font-semibold tracking-wide text-left">#</th>
          <th class="w-20 p-3 text-base font-semibold tracking-wide text-left">ชื่อผู้ใช้งาน</th>
          <th class="w-20 p-3 text-base font-semibold tracking-wide text-left">ชื่อ สกุล</th>
          <th class="w-20 p-3 text-base font-semibold tracking-wide text-left">หน่วยงาน</th>
          <th class="w-64 lg:w-72 p-3 text-base font-semibold tracking-wide text-left">Action</th>
          <th class="w-32 p-3 text-base font-semibold tracking-wide text-left">ช่วงเวลา</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
            @forelse ($logAvtivitys as $key =>$logAvtivity)
               <tr class="bg-white">
                  <td class="p-3 text-base text-gray-700 align-text-top">
                     {{++$key}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                     {{$logAvtivity->username}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                     {{$logAvtivity->full_name}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                     {{$logAvtivity->office_name}}
                  </td>
                  <td class="p-3 text-base text-gray-700 align-text-top">
                     {{$logAvtivity->action}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                     {{$logAvtivity->thai_activity_date}}
                  </td>
               </tr>
            @empty
            <tr class="col-span-6 text-shadow-sm font-semibold flex justify-center py-5">
               <td >
                  <p class="text-rose-600 text-2xl ">ไม่พบข้อมูล</p>
               </td>
            </tr>
            @endforelse
        </tbody>
      </table>
    </div>
 
    <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:hidden mt-4">
      @forelse ($logAvtivitys as $key =>$logAvtivity)
      <div class="bg-white space-y-3 p-4 rounded-lg shadow">
        <div class="flex items-center space-x-2 text-base">
          <div>
            <a href="#" class="text-blue-500 font-bold">#{{++$key}}</a>
          </div>
          <div class="text-gray-900">{{$logAvtivity->thai_activity_date}}</div>
          <div>
            {{$logAvtivity->username}}
          </div>
        </div>
        <div class="text-base text-gray-900">
          ชื่อ สกุล : {{$logAvtivity->full_name}}
        </div>
        <div class="text-base text-gray-900">
         หน่วยงาน : {{$logAvtivity->office_name}}
       </div>
        <div class="text-base font-medium text-gray-900">
         Action : {{$logAvtivity->action}}
        </div>
      </div>
      @empty
         <p class="text-rose-600 text-2xl text-shadow-sm font-semibold flex justify-center pt-5">ไม่พบข้อมูล</p>
      @endforelse
    </div>
</section>
@endsection