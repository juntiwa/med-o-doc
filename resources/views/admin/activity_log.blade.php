@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<div class="flex flex-row-reverse mr-3">

   <form action="{{ route('activitylog.export') }}" method="get">
      <button type="submit" class="flex flex-row justify-center items-center w-full px-4 py-3 font-medium text-white 
      bg-blue-800 rounded hover:bg-blue-900 ease-in-out">
         <svg width="20" height="20" class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
            <path d="M480 352h-133.5l-45.25 45.25C289.2 409.3 273.1 416 256 416s-33.16-6.656-45.25-18.75L165.5 352H32c-17.67 0-32 14.33-32 32v96c0 17.67 14.33 32 32 32h448c17.67 0 32-14.33 32-32v-96C512 366.3 497.7 352 480 352zM432 456c-13.2 0-24-10.8-24-24c0-13.2 10.8-24 24-24s24 10.8 24 24C456 445.2 445.2 456 432 456zM233.4 374.6C239.6 380.9 247.8 384 256 384s16.38-3.125 22.62-9.375l128-128c12.49-12.5 12.49-32.75 0-45.25c-12.5-12.5-32.76-12.5-45.25 0L288 274.8V32c0-17.67-14.33-32-32-32C238.3 0 224 14.33 224 32v242.8L150.6 201.4c-12.49-12.5-32.75-12.5-45.25 0c-12.49 12.5-12.49 32.75 0 45.25L233.4 374.6z" />
         </svg>
         Export
      </button>
   </form>
</div>

<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">#</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ชื่อ สกุล</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">หน่วยงาน</th>
            <th class="w-60 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Action</th>
            <th class="w-40 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Date time</th>
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
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top ">
               {{ $item->full_name }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top ">
               {{ $item->office_name }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top whitespace-normal">
               {{ $item->action }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->thaidate() }}
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
      <div class="flex justify-between items-center space-x-2 text-base ">
         <!-- username -->
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               {{ $item->username }}
            </p>
         </div>
         <!-- ชนิดหนังสือ -->
         <div>
            @if($item->method == "POST")
            <div class="p-1.5 uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50 text-center">{{ $item->method }}</div>
            @else
            <div class="p-1.5 uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50 text-center">{{ $item->method }}</div>
            @endif
         </div>
      </div>
      <div class="flex text-base justify-between">
         <!-- program_name -->
         <div class="text-gray-700">
            {{ $item->thaidate() }}
         </div>

      </div>
      <div class="flex text-base text-gray-700 font-medium">
         {{ $item->action }}
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
<div class="col-md-12 mt-6 mb-6">
   {{ $activityLog->withQueryString()->links('pagination::tailwind') }}
</div>
@endsection