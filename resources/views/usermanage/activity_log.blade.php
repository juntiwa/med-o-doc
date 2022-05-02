@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
<div class="flex flex-row-reverse">
   <a href="{{route('delete.activitylog')}}" onclick="return confirm('Are you sure to want to delete it?')">
      <button class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-base leading-tight uppercase rounded 
                     shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 
                     active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out ml-6">
         ลบ <i class="uil uil-trash-alt pl-2 text-lg"></i>
      </button>
   </a>
   <a href="{{ route('activitylog.export') }}">
      <button type="button" class="inline-block px-6 py-2.5 bg-purple-600 text-white font-medium text-base  leading-tight 
         uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none 
         focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out">
         Export Data <i class="uil uil-file-export  pl-2 text-lg"></i>
      </button>
   </a>

</div>


<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ลำดับ </th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ชื่อผู้ใช้ </th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ภาควิชา</th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ACTION</th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">เมื่อ</th>
         </tr>
      </thead>
      @if(isset($activityLog))
      <tbody class="divide-y divide-gray-100">
         @if(count($activityLog)>0)
         @foreach ($activityLog as $key => $item)
         <tr class="bg-white">
            <!-- ลำดับ -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ ++$key }}
            </td>
            <!-- username ผู้ใช้งาน -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->username }}
            </td>
            <!-- email ผู้ใช้งาน -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->program_name }}
            </td>
            <!-- action -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               @if ($item->description == "login" )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50">{{$item->action}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50">{{$item->action}}</span>
               @endif
            </td>
            <!-- เมื่อ -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->date_time }}
            </td>

         </tr>
         @endforeach
         @else
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap">
               <p class="font-bold text-red-600">
                  ไม่พบข้อมูล
               </p>
            </td>
         </tr>
         @endif
      </tbody>
      @endif
   </table>
</div>

<!-- card -->
<div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:hidden mt-4">
   <!-- ก่อนค้นหา -->
   @if(isset($activityLog))
   @if(count($activityLog)>0)
   @foreach ($activityLog as $key => $item)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">

      <div class="flex text-base justify-between">
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               {{ $item->username }}
            </p>
         </div>
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-nowrap">
               @if ($item->description == "login" )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50">{{$item->action}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50">{{$item->action}}</span>
               @endif
            </span>
         </div>
      </div>
      <!-- จาก -->
      <div class="flex text-gray-700">
         {{ $item->program_name }}
      </div>
   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif
</div>


<div class="col-md-12 mt-6">
   {{ $activityLog->withQueryString()->links('pagination::tailwind') }}
</div>
@endsection