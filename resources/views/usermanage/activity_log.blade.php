@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
<div class="flex flex-row-reverse">
   <a href="{{route('delete.activitylog')}}" onclick="return confirm('Are you sure to want to delete it?')">
      <button class="inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-base leading-tight uppercase rounded 
      shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 
      active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out ml-6">
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
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">#</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Username</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Program Name</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">URL</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Method</th>
            <th class="w-80 lg:w-96 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">User Agent</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Action</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Date time</th>
         </tr>
      </thead>
      <!-- ก่อนค้นหา -->
      @if(isset($activityLog))
      <tbody class="divide-y divide-gray-100 items-start">
         @if(count($activityLog)>0)
         @foreach($activityLog as $key => $item)
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium lg:whitespace-nowrap align-text-top">
               {{++$key}}
            </td>
            <!-- หัวเรื่อง -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap flex justify-center ">
               {{ $item->username }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->program_name }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->url }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->method }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->user_agent }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->action }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
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
   @if(isset($activityLog))
   @if(count($activityLog)>0)
   @foreach($activityLog as $key => $item)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">
      <div class="flex items-center space-x-2 text-base ">
         <!-- username -->
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               {{ $item->username }}
            </p>
         </div>
      </div>
      <div class="flex text-base justify-between">
         <!-- program_name -->
         <div class="text-gray-700">
            {{ $item->thaidate() }}
         </div>
         <!-- ชนิดหนังสือ -->
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-nowrap">
               @if ($item->method == "POST" )
               <span class="rounded text-emerald-400 text-base ">{{ $item->method }}</span>
               @else
               <span class="rounded text-red-400 text-base ">{{ $item->method }}</span>
               @endif
            </span>
         </div>
      </div>
      <div class="flex text-gray-700">
         @if ($item->action == "login" )
         <span class="rounded text-emerald-400 text-base ">{{$item->action}}</span>
         @else
         <span class="rounded text-red-400 text-base ">{{$item->action}}</span>
         @endif
      </div>
      <div class="text-base text-gray-700">
         {{ $item->user_agent }}
      </div>

      <div class="flex text-base text-gray-700 pt-10">
         <div class="absolute left-3 bottom-3 min-h-max max-h-full ">
            {{ $item->url }}
         </div>
      </div>
   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif

</div>

<!-- pagination -->
<div class="col-md-12 mt-6">
   {{ $activityLog->withQueryString()->links('pagination::tailwind') }}
</div>
@endsection