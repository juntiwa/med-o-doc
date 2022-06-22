@extends('layouts.app')
@section('title', 'สิทธิ์การเข้าถึงระบบ')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<div class="btnAddmember">
   <form action="{{route('permission.create')}}" method="get">
      <button type="submit" class="addMember flex justify-center items-center">
         <svg class="add_member" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
            <path
               d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z" />
         </svg>
         <p class=" text-base text-white">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</p>
      </button>
   </form>
</div>
@if(Session::has('success'))
   <label class="alert-danger">{{Session::get('success')}}</label>
 @endif
<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">#</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">SAPID</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ชื่อผู้ใช้งาน</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ชื่อ สกุล</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">หน่วยงาน</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">สิทธิ์การเข้าถึง</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">สถานะ</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">แก้ไข</th>
         </tr>
      </thead>
      @if(isset($permiss))
      <tbody class="divide-y divide-gray-100 items-start">
         @if(count($permiss)>0)
         @foreach($permiss as $key => $item)
         {{-- หน่วยงาน user = หน่วยเวชสารสนเทศและบริหารข้อมูล --}}
         @if (Auth::user()->office_name == "หน่วยเวชสารสนเทศและบริหารข้อมูล")
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium lg:whitespace-nowrap align-text-top flex justify-center">
               {{++$key}}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               <div class="flex">
                  <p id="sap_hidden{{$item->sapid()}}">100xxxxx</p>
                  <p id="sap_show{{$item->sapid()}}"></p>
                  <div class="bg-white ml-1">
                     <div class="flex items-center justify-center space-x-2" id="show">
                        <label for="{{$item->sapid()}}"
                           class="inline-flex relative items-center mr-5 cursor-pointer">
                           <input type="checkbox" id="{{$item->sapid()}}"
                              class="switch{{$item->sapid()}} sr-only peer" onClick="sap_click(this.id)">
                           <div id="switch_toggle" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-teal-300 
                              peer-checked:after:translate-x-full peer-checked:after:border-white 
                              after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 
                              after:border after:rounded-full after:h-5 after:w-5 after:transition-all  
                              peer-checked:bg-slate-100">
                           </div>
                        </label>
                     </div>
               </div>
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->username }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               @if($item->full_name == '')
               <p class="table-row__p-status status--red text-base">ระหว่างรอ update</p>
               @else
               {{ $item->full_name }}
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->office_name }}
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
               <div class="w-full flex justify-center items-end">
                  @if (Auth::user()->office_name == $item->office_name)
                     @if ($item->office_name == "หน่วยเวชสารสนเทศและบริหารข้อมูล" && Auth::user()->org_id != $item->org_id)
                     {{-- {{Auth::user()->org_id }} --}}
                        <a href="{{route('permission.edit', $item->org_id)}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400">
                              <path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0 
                                 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z">
                              </path>
                           </svg>
                        </a>
                     @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-rose-500">
                           <path d="M7 10h10v4H7z"></path>
                           <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                        </svg>
                     @endif
                  @else
                     <a href="{{route('permission.edit', $item->org_id)}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400"><path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z"></path></svg>
                     </a>
                  @endif
               </div>
            </td>
         </tr>
         @else
         {{-- หน่วยงาน user != หน่วยเวชสารสนเทศและบริหารข้อมูล
            และ query ข้อมูลแสดงข้อมูลที่หน่วยงานไม่เท่ากับ หน่วยเวชสารสนเทศและบริหารข้อมูล --}}
         @if($item->office_name != "หน่วยเวชสารสนเทศและบริหารข้อมูล")
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium lg:whitespace-nowrap align-text-top flex justify-center">
               {{++$key}}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               <div class="flex">
                  <p id="sap_hidden{{$item->sapid()}}">100xxxxx</p>
                  <p id="sap_show{{$item->sapid()}}"></p>
                  <div class="bg-white ml-1">
                     <div class="flex items-center justify-center space-x-2" id="show">
                        <label for="{{$item->sapid()}}"
                           class="inline-flex relative items-center mr-5 cursor-pointer">
                           <input type="checkbox" id="{{$item->sapid()}}"
                              class="switch{{$item->sapid()}} sr-only peer" onClick="sap_click(this.id)">
                           <div id="switch_toggle" class="w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-teal-300 
                              peer-checked:after:translate-x-full peer-checked:after:border-white 
                              after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-white after:border-gray-300 
                              after:border after:rounded-full after:h-5 after:w-5 after:transition-all  
                              peer-checked:bg-slate-100">
                           </div>
                        </label>
                     </div>
               </div>
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->username }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               @if($item->full_name == '')
               <p class="table-row__p-status status--red text-base">ระหว่างรอ update</p>
               @else
               {{ $item->full_name }}
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->office_name }}
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
               <div class="w-full flex justify-center items-end">
                  @if (Auth::user()->office_name == $item->office_name)
                     @if ($item->office_name == "หน่วยเวชสารสนเทศและบริหารข้อมูล")
                        <a href="{{route('permission.edit', $item->org_id)}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400"><path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z"></path></svg>
                        </a>
                     @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-rose-500">
                           <path d="M7 10h10v4H7z"></path>
                           <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                        </svg>
                     @endif
                  @else
                     <a href="{{route('permission.edit', $item->org_id)}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400"><path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z"></path></svg>
                     </a>
                  @endif
               </div>
            </td>
         </tr>
         @endif
         @endif
        
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
            <a href="{{route('permission.edit', $item->id)}}">
               <svg data-toggle="tooltip" data-placement="bottom" title="Edit" version="1.1" class="table-row__edit"
                  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                  viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                  <g>
                     <g>
                        <path
                           d="M496.063,62.299l-46.396-46.4c-21.2-21.199-55.69-21.198-76.888,0l-18.16,18.161l123.284,123.294l18.16-18.161    C517.311,117.944,517.314,83.55,496.063,62.299z"
                           style="fill: rgb(1, 185, 209);"></path>
                     </g>
                  </g>
                  <g>
                     <g>
                        <path
                           d="M22.012,376.747L0.251,494.268c-0.899,4.857,0.649,9.846,4.142,13.339c3.497,3.497,8.487,5.042,13.338,4.143    l117.512-21.763L22.012,376.747z"
                           style="fill: rgb(1, 185, 209);"></path>
                     </g>
                  </g>
                  <g>
                     <g>
                        <polygon points="333.407,55.274 38.198,350.506 161.482,473.799 456.691,178.568   "
                           style="fill: rgb(1, 185, 209);"></polygon>
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

<script type="text/javascript">
   function sap_click(clicked) {
      var el_up = document.getElementById("sap_show" + clicked);
      el_up.innerHTML = clicked;
      $('.switch' + clicked).prop('disabled', true)
      $('#sap_hidden' + clicked).addClass('hidden')
      // console.log(clicked);

      $.ajax({
         url: "{{ route('look.sapid') }}",
         type: 'post',
         data: {
            sapid: clicked
         },
         success: function (result) {
            // console.log(result);
         }
      });
   }
</script>
@endsection