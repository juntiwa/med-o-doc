@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
<form action="{{route('save.permis')}}" method="post">
   @csrf
   <div id="InputGroup" class="mt-6 p-6 grid grid-cols-1 gap-4 ">
      <div id="InputDiv1" class="flex justify-start">
         <div class="mb-3 xl:w-96 pr-5">
            <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 1</label>
            <input required type="text" name="username" id="username1" placeholder="กรอกชื่อ . นามสกุล 3 ตัว" class="input input-bordered w-full max-w-xs text-base font-normal" value="">
         </div>
         <div class="mb-3 xl:w-96 pl-5">
            <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select required class="select select-bordered w-full max-w-xs text-base font-normal" name="permis" id="permis1">
               <option disabled selected>--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
   </div>

   <div class="mt-2 p-6 grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4">
      <button class="inline-block px-6 py-2.5 bg-teal-500 text-white font-medium text-base leading-tight uppercase rounded 
      shadow-md hover:bg-teal-600 hover:shadow-lg focus:bg-teal-600 focus:shadow-lg focus:outline-none focus:ring-0 
      active:bg-teal-700 active:shadow-lg transition duration-150 ease-in-out" type=" submit">
         บันทึกข้อมูล <i class="uil uil-file-bookmark-alt pl-2 text-lg"></i>
      </button>

      <button class="inline-block px-6 py-2.5 bg-blue-400 text-white font-medium text-base leading-tight uppercase rounded 
      shadow-md hover:bg-blue-500 hover:shadow-lg focus:bg-blue-500 focus:shadow-lg focus:outline-none focus:ring-0 
      active:bg-blue-600 active:shadow-lg transition duration-150 ease-in-out" id='addButton'>
         เพิ่มช่องกรอกข้อมูล <i class="uil uil-plus-circle pl-2 text-lg"></i>
      </button>

      <button class="inline-block px-6 py-2.5 bg-red-600 text-white font-medium text-base leading-tight uppercase rounded 
      shadow-md hover:bg-red-700 hover:shadow-lg focus:bg-red-700 focus:shadow-lg focus:outline-none focus:ring-0 
      active:bg-red-800 active:shadow-lg transition duration-150 ease-in-out" id='removeButton'>
         ลบช่องกรอกข้อมูล <i class="uil uil-minus-circle pl-2 text-lg"></i>
      </button>
   </div>

</form>

<table class="border-collapse w-full hidden lg:block">
   <thead>
      <tr>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center rounded-tl-lg">#</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">Username</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">Full Name</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell">Role</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center">Status</th>
         <th class="p-3 font-bold uppercase bg-gray-50 border border-gray-200 text-slate-600 hidden lg:table-cell text-center">Edit</th>
      </tr>
   </thead>
   @if(isset($permiss))
   <tbody>
      @if(count($permiss)>0)
      @foreach ($permiss as $key => $item)
      <tr class="bg-white lg:hover:bg-gray-100 flex lg:table-row flex-row lg:flex-row flex-wrap lg:flex-no-wrap mb-10 lg:mb-0">
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50 block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">#</span>
            {{ ++$key }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Username</span>
            {{ $item->username }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Full Name</span>
            {{ $item->full_name }}
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Role</span>

            @if ($item->is_admin == "1" )
            <span class="rounded text-emerald-400 text-base ">Admin</span>
            @else
            <span class="rounded text-red-400 text-base ">User</span>
            @endif
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Status</span>
            @if ($item->status == "Active" )
            <span class="rounded text-emerald-400 text-base ">{{$item->status}}</span>
            @else
            <span class="rounded text-red-400 text-base ">{{$item->status}}</span>
            @endif
         </td>
         <td class="w-full lg:w-auto p-3 text-gray-800 text-center border border-gray-50  block lg:table-cell relative lg:static">
            <span class="lg:hidden absolute top-0 left-0 bg-blue-200 px-2 py-1 text-base font-bold uppercase">Edit</span>
            <a href="{{route('edit.permis', $item->id)}}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>
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
   @if(isset($permiss))
   @if(count($permiss)>0)
   @foreach($permiss as $key => $item)
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
            {{ $item->full_name }}
         </div>
         <!-- ชนิดหนังสือ -->
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-nowrap">
               @if ($item->is_admin == "1" )
               <span class="rounded text-emerald-400 text-base">Admin</span>
               @else
               <span class="rounded text-red-400 text-base">User</span>
               @endif
            </span>
         </div>
      </div>
      <div class="flex text-gray-700 text-base">
         สถานะการใช้งาน : 
         @if ($item->status == "Active" )
         <span class="rounded text-emerald-400 text-base "> {{$item->status}}</span>
         @else
         <span class="rounded text-red-400 text-base "> {{$item->status}}</span>
         @endif
      </div>

      <div class="flex text-base text-gray-700 pt-10">
         <div class="absolute left-3 bottom-3 min-h-max max-h-full ">
            <a href="{{route('edit.permis', $item->id)}}" class="text-blue-400 hover:text-blue-600 underline">Edit</a>

         </div>
      </div>
   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif

</div>

<div class="col-md-12 mt-6">
   {{ $permiss->withQueryString()->links('pagination::tailwind') }}
</div>

<script type="text/javascript">
   $(document).ready(function() {

      var counter = 2;

      $("#addButton").click(function() {

         if (counter > 10) {
            alert("Only 10 textboxes allow");
            return false;
         }

         var newInputDiv = $(document.createElement('div'))
            .attr("id", 'InputDiv' + counter)
            .attr("class", 'flex justify-start');

         newInputDiv.after().html('<div class="mb-3 xl:w-96 pr-5">' +
            '<label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน ' + counter + ' </label>' +
            '<input required type="text" name="username" id="username' + counter +
            '" placeholder="กรอกชื่อ . นามสกุล 3 ตัว" class="input input-bordered w-full max-w-xs text-base font-normal" value="">' +
            '</div>' +
            '<div class="mb-3 xl:w-96 pl-5">' +
            '<label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">เลือกสิทธิ์การใช้งาน</label>' +
            '<select required class = "select select-bordered w-full max-w-xs text-base font-normal" name="permis" id="permis' + counter +
            '">' +
            '<option disabled selected >--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>' +
            '<option value="1">ผู้ดูแลระบบ</option>' +
            '<option value="0">ผู้ใช้งานทั่วไป</option>' +
            '</select>');

         newInputDiv.appendTo("#InputGroup");
         counter++;
      });

      $("#removeButton").click(function() {
         if (counter == 1) {
            alert("No more textbox to remove");
            return false;
         }

         counter--;

         $("#InputDiv" + counter).remove();

      });
   });
</script>
@endsection