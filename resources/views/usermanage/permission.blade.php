@extends('layouts.app')
@section('title', 'สิทธิ์การเข้าถึงระบบ')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<div class="btnAddmember">
   <form action="{{route('addPermis')}}" method="get">
      <button type="submit" class="addMember flex justify-center items-center">
         <svg class="add_member" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z" />
         </svg>
         <p class=" text-base text-white">Add member</p>
      </button>
   </form>
</div>
<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">#</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Username</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">Full Name</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Role</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">status</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">Edit</th>
         </tr>
      </thead>
      @if(isset($permiss))
      <tbody class="divide-y divide-gray-100 items-start">
         @if(count($permiss)>0)
         @foreach($permiss as $key => $item)
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium lg:whitespace-nowrap align-text-top flex justify-center">
               {{++$key}}
            </td>
            <!-- หัวเรื่อง -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap ">
               {{ $item->username }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               @if($item->full_name == '')
               <p class="table-row__p-status status--red text-base">ระหว่างรอ update</p>
               @else
               {{ $item->full_name }}
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top text-center">
               @if ($item->is_admin == "1" )
               <p class="table-row__p-status status--red status text-base">Admin</p>
               @else
               <p class="table-row__p-status status--yellow status text-base">User</p>
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top text-center">
               @if ($item->status == "Active" )
               <p class="table-row__status status--green status text-base">{{$item->status}}</p>
               @else
               <p class="table-row__status text-base">{{$item->status}}</p>
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium text-center align-text-top ">
               <a href="{{route('edit.permis', $item->id)}}">
                  <svg data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                     <g>
                        <g>
                           <path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>
                        </g>
                     </g>
                     <g>
                        <g>
                           <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>
                        </g>
                     </g>
                     <g>
                        <g>
                           <polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>
                        </g>
                     </g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                     <g></g>
                  </svg>
               </a>
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
   @if(isset($permiss))
   @if(count($permiss)>0)
   @foreach($permiss as $key => $item)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">
      <div class="flex items-center space-x-2 text-base ">
         <!-- username -->
         <div>
            <p class="text-blue-500 text-lg font-semibold hover:underline">
               {{ $item->username }}
            </p>
         </div>
         <div>
            <a href="{{route('edit.permis', $item->id)}}">
               <svg data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                  <g>
                     <g>
                        <path d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z" style="fill: rgb(1, 185, 209);"></path>
                     </g>
                  </g>
                  <g>
                     <g>
                        <path d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z" style="fill: rgb(1, 185, 209);"></path>
                     </g>
                  </g>
                  <g>
                     <g>
                        <polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   " style="fill: rgb(1, 185, 209);"></polygon>
                     </g>
                  </g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
               </svg>
            </a>
         </div>
      </div>
      <div class="flex text-base justify-between">
         <!-- full_name -->
         <div class="text-gray-700">
            @if($item->full_name == '')
            <p class="table-row__p-status status--red text-base">ระหว่างรอ update</p>
            @else
            {{ $item->full_name }}
            @endif
         </div>
         <!-- role -->
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-nowrap">
               @if ($item->is_admin == "1" )
               <p class="table-row__p-status status--red status text-base">Admin</p>
               @else
               <p class="table-row__p-status status--yellow status text-base">User</p>
               @endif
            </span>
         </div>
      </div>
      <div class="flex text-gray-700 text-base">
         สถานะการใช้งาน :
         @if ($item->status == "Active" )
         <p class="table-row__status status--green status text-base pl-3">{{$item->status}}</p>
         @else
         <p class="table-row__status text-base pl-3">{{$item->status}}</p>
         @endif
      </div>


   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif

</div>

<div class="col-md-12 mt-6 mb-6">
   {{ $permiss->withQueryString()->links('pagination::tailwind') }}
</div>

@endsection