@extends('layouts.app')
@section('title', 'เพิ่มข้อมูลสิทธิ์การเข้าถึง')
@section('sidebar')
@parent
@endsection
@section('content')

<form action="{{route('save.permis')}}" method="post">
   @csrf
   <div class="flex justify-end">
      <div class="mt-2 p-6 grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4">
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
   </div>

   <div id="InputGroup" class="grid grid-cols-1 gap-4 ">
      <div id="InputDiv1" class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1gap-4">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 1<span class="text-lg text-red-600">*</span></label>
            <input required type="text" name="username" id="username1" placeholder="กรอกชื่อ . นามสกุล 3 ตัว" class=" form-control block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" value="{{ old('username') }}">
            @error('message')
            <p class="text-base text-red-500 w-5/6 mb-3 mt-3">
               {{ $message }}
            </p>
            @enderror
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง <span class="text-lg text-red-600">*</span></label>
            <select required name="permis" id="permis1" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option disabled selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
   </div>
   <div class="flex justify-end mt-2 p-6">
      <button class="inline-block px-6 py-2.5 bg-teal-500 text-white font-medium text-base leading-tight uppercase rounded 
      shadow-md hover:bg-teal-600 hover:shadow-lg focus:bg-teal-600 focus:shadow-lg focus:outline-none focus:ring-0 
      active:bg-teal-700 active:shadow-lg transition duration-150 ease-in-out" type=" submit">
         บันทึกข้อมูล <i class="uil uil-file-bookmark-alt pl-2 text-lg"></i>
      </button>
   </div>
</form>

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
            .attr("class", 'grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1gap-4');

         newInputDiv.after().html('<div class="mb-3 xl:w-96 pr-10">' +
            '<label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน ' + counter + ' </label>' +
            '<input required type="text" name="username" id="username' + counter +
            '" placeholder="กรอกชื่อ . นามสกุล 3 ตัว" class=" form-control block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"' +
            'value="{{ old("username") }}">' +
            '@error("message") <p class = "text-base text-red-500 w-5/6 mb-3 mt-3" > $message</p>@enderror' +
            '</div>' +
            '<div class="mb-3 xl:w-96 pr-10">' +
            '<label for="exampleFormControlInput1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">เลือกสิทธิ์การใช้งาน</label>' +
            '<select required name="permis" id="permis1" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example"' + counter +
            '">' +
            '<option disabled selected value="" >--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>' +
            '<option value="1">ผู้ดูแลระบบ</option>' +
            '<option value="0">ผู้ใช้งานทั่วไป</option>' +
            '</select>');

         newInputDiv.appendTo("#InputGroup");
         counter++;
      });

      $("#removeButton").click(function() {
         if (counter == 2) {
            alert("ไม่สามารถลบช่องกรอกข้อมูลได้");
            return false;
         }

         counter--;

         $("#InputDiv" + counter).remove();

      });
   });
</script>
@endsection