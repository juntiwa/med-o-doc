<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'ค้นหาเอกสาร')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
{!! Toastr::message() !!}
<section id="button" class="flex items-end justify-end w-full">
   <a href="{{route('logactivity.export')}}" role="button" class="flex items-end justify-end w-fit px-3 py-2 rounded-md bg-rose-900 hover:bg-rose-800 text-white">
   <svg xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" class="mr-3">
      <path class="fill-white" d="M8.71,7.71,11,5.41V15a1,1,0,0,0,2,0V5.41l2.29,2.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42l-4-4a1,1,0,0,0-.33-.21,1,1,0,0,0-.76,0,1,1,0,0,0-.33.21l-4,4A1,1,0,1,0,8.71,7.71ZM21,14a1,1,0,0,0-1,1v4a1,1,0,0,1-1,1H5a1,1,0,0,1-1-1V15a1,1,0,0,0-2,0v4a3,3,0,0,0,3,3H19a3,3,0,0,0,3-3V15A1,1,0,0,0,21,14Z"/>
   </svg>
      Export ประวัติการใช้งาน
   </a>
</section>
<section id="displayLogActivity">
   <div class="overflow-auto rounded-lg shadow-md hidden mt-6 lg:block">
      <table class="w-full">
      <thead class="bg-gray-100 border-b-2 border-gray-200">
        <tr>
          <th class="w-20 p-3 text-base font-semibold text-left">#</th>
          <th class="w-20 p-3 text-base font-semibold text-left">ชื่อผู้ใช้งาน</th>
          <th class="w-20 p-3 text-base font-semibold text-left">ชื่อ สกุล</th>
          <th class="w-20 p-3 text-base font-semibold text-left">หน่วยงาน</th>
          <th class="w-64 lg:w-72 p-3 text-base font-semibold text-left">Action</th>
          <th class="w-32 p-3 text-base font-semibold text-left">ช่วงเวลา</th>
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
            <tr class="col-span-6 text-shadow-sm font-semibold flex pl-2 py-5">
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

    <div class="col-md-12 mt-6 mb-6">
      {{$logAvtivitys->links('pagination::tailwind')}}
   </div>
</section>
@endsection