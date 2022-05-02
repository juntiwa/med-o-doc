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
               <option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>
               <option value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>
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

<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block ">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-12 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ลำดับ </th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ชื่อผู้ใช้ </th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">สิทธิ์เข้าถึง</th>
            <th class="w-24 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ลบ</th>
         </tr>
      </thead>
      @if(isset($permiss))
      <tbody class="divide-y divide-gray-100">
         @if(count($permiss)>0)
         @foreach ($permiss as $key => $item)
         <tr class="bg-white">
            <!-- ลำดับ -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top text-center">
               {{ ++$key }}
            </td>
            <!-- username ผู้ใช้งาน -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->username }}
            </td>
            <!-- email ผู้ใช้งาน -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top">
               {{ $item->role_name }}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium whitespace-nowrap align-text-top text-center">
               <a href="{{url('delete_permis/'.$item->id)}}" onclick="return confirm('Are you sure to want to delete it?')">
                  <button class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-base leading-tight uppercase rounded 
                     shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 
                     active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
                     ลบ <i class="uil uil-trash-alt pl-2 text-lg"></i>
                  </button>
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
   <!-- ก่อนค้นหา -->
   @if(isset($permiss))
   @if(count($permiss)>0)
   @foreach ($permiss as $key => $item)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">

      <div class="flex text-base justify-between">
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               {{ $item->username }}
            </p>
         </div>
         <div class="flex text-gray-700">
            {{ $item->role_name }}
         </div>

      </div>
      <div class="flex justify-end">
         <a href="{{url('delete_permis/'.$item->id)}}" onclick="return confirm('Are you sure to want to delete it?')">
            <button class="inline-block px-6 py-2.5 bg-yellow-500 text-white font-medium text-base leading-tight uppercase rounded 
                     shadow-md hover:bg-yellow-600 hover:shadow-lg focus:bg-yellow-600 focus:shadow-lg focus:outline-none focus:ring-0 
                     active:bg-yellow-700 active:shadow-lg transition duration-150 ease-in-out">
               ลบ <i class="uil uil-trash-alt pl-2 text-lg"></i>
            </button>
         </a>
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
            '<option value="ผู้ดูแลระบบ">ผู้ดูแลระบบ</option>' +
            '<option value="ผู้ใช้งานทั่วไป">ผู้ใช้งานทั่วไป</option>' +
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