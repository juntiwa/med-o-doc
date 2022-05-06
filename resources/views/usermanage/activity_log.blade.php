@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
<div class="flex flex-row-reverse mt-6">
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


<table class="border-collapse w-full overflow-auto block mt-7 hidden lg:block">
   <thead>
      <tr>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center rounded-tl-lg">#</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">Username</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center">Program Name</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">URL</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">Method</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center">User Agent</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center">Action</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center rounded-tr-lg">Date Time</th>
      </tr>
   </thead>
   @if(isset($activityLog))
   <tbody>
      @if(count($activityLog)>0)
      @foreach ($activityLog as $key => $item)
      <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50 block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">#</span>
            {{ ++$key }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Username</span>
            {{ $item->username }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Program Name</span>
            {{ $item->program_name }}
         </td>
         <td class="w-full lg:w-14 p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">URL</span>
            {{ $item->url }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Method</span>

            @if ($item->method == "POST" )
            <span class="rounded text-emerald-400 text-base ">{{ $item->method }}</span>
            @else
            <span class="rounded text-red-400 text-base ">{{ $item->method }}</span>
            @endif
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">User Agent</span>
            {{ $item->user_agent }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Action</span>
            @if ($item->action == "login" )
            <span class="rounded text-emerald-400 text-base ">{{$item->action}}</span>
            @else
            <span class="rounded text-red-400 text-base ">{{$item->action}}</span>
            @endif
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Date Time</span>
            {{ $item->thaidate() }}
         </td>
      </tr>
      @endforeach
      @else
      <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50 block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Company name</span>
            ไม่พบข้อมูล
         </td>
      </tr>
      @endif
   </tbody>
   @endif
</table>

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