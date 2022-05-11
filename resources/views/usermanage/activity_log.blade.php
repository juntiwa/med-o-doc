@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
<div class="flex flex-row-reverse mr-3">
   <a href="{{route('delete.activitylog')}}" onclick="return confirm('คุณต้องการลบข้อมูลหรือไม่ ?')">
      <button class="flex flex-row justify-center items-center w-full px-4 py-3 font-medium text-white
         bg-green-600 rounded hover:bg-green-700 ease-in-out ml-6">
         <svg width="20" height="20" class="fill-white mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
            <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
            <path d="M160 400C160 408.8 152.8 416 144 416C135.2 416 128 408.8 128 400V192C128 183.2 135.2 176 144 176C152.8 176 160 183.2 160 192V400zM240 400C240 408.8 232.8 416 224 416C215.2 416 208 408.8 208 400V192C208 183.2 215.2 176 224 176C232.8 176 240 183.2 240 192V400zM320 400C320 408.8 312.8 416 304 416C295.2 416 288 408.8 288 400V192C288 183.2 295.2 176 304 176C312.8 176 320 183.2 320 192V400zM317.5 24.94L354.2 80H424C437.3 80 448 90.75 448 104C448 117.3 437.3 128 424 128H416V432C416 476.2 380.2 512 336 512H112C67.82 512 32 476.2 32 432V128H24C10.75 128 0 117.3 0 104C0 90.75 10.75 80 24 80H93.82L130.5 24.94C140.9 9.357 158.4 0 177.1 0H270.9C289.6 0 307.1 9.358 317.5 24.94H317.5zM151.5 80H296.5L277.5 51.56C276 49.34 273.5 48 270.9 48H177.1C174.5 48 171.1 49.34 170.5 51.56L151.5 80zM80 432C80 449.7 94.33 464 112 464H336C353.7 464 368 449.7 368 432V128H80V432z" />
         </svg>
         ลบ
      </button>
   </a>

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
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Username</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Program Name</th>
            <th class="w-80 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Action</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">URL</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Method</th>
            <!-- <th class="w-48 lg:w-96 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">User Agent</th> -->
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
            <td class="p-3 text-base text-gray-800 font-medium align-text-top whitespace-normal">
               {{ $item->action }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{ $item->url }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top text-center">
               @if($item->method == "POST")
               <div class="badge badge-opacity-danger text-base">{{ $item->method }}</div>
               @else
               <div class="badge badge-opacity-warning text-base">{{ $item->method }}</div>
               @endif
            </td>
            <!-- <td class="p-3 text-base text-gray-800 font-medium align-text-top whitespace-normal">
               {{ $item->user_agent }}
            </td> -->

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
               @if($item->method == "POST")
               <div class="badge badge-opacity-danger text-base">{{ $item->method }}</div>
               @else
               <div class="badge badge-opacity-warning text-base">{{ $item->method }}</div>
               @endif
            </span>
         </div>
      </div>
      <div class="flex text-base text-gray-700">
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