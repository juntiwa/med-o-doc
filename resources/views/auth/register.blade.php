@extends('layouts.guest')
@section('title', 'เข้าสู่ระบบ')
@section('content')

{!! Toastr::message() !!}

@include('fonts/sarabun')
<div class="font-sarabun flex justify-center items-center h-screen p-4 bg-white sm:p-6 lg:p-8">
   <form class="space-y-6  w-5/12" action="{{ route('register.store') }}" method="get">
       <h5 class="text-xl font-medium text-gray-900">ระบุข้อมูลเพื่อเข้าใช้งานระบบ</h5>
       <div class="grid grid-cols-2 gap-4">
         <div>
            <label for="org_id" class="block mb-2 text-base font-medium text-gray-900">รหัสพนักงาน</label>
            <input type="text" name="org_id" id="org_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="รหัสพนักงาน" readonly value="{{$org_id}}">
        </div>
         <div>
            <label for="login" class="block mb-2 text-base font-medium text-gray-900">ชื่อผู้ใช้งาน</label>
            <input type="text" name="login" id="login" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="ชื่อผู้ใช้งาน" disabled value="{{$login}}">
      </div>
       </div>
       
       <div>
           <label for="full_name" class="block mb-2 text-base font-medium text-gray-900">ชื่อ สกุล <span class="text-rose-600">*</span></label>
           <input type="text" name="full_name" id="full_name" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
           focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="ชื่อ นามสกุล" required="" value="{{$full_name}}">
       </div>
       <div>
           <label for="office_name" class="block mb-2 text-base font-medium text-gray-900">หน่วยงาน <span class="text-rose-600">*</span></label>
           <select name="office_name" id="office_name" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
           focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 " required>
            <option selected value="">เลือกหน่วยงานของคุณ</option>
            @foreach ($units as $unit)
               <option value="{{$unit->unitid}}"> {{$unit->unitname}} </option>
            @endforeach
          </select>
       </div>
       
       <button type="submit" class="w-full text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none 
       focus:ring-teal-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">เข้าใช้งานระบบ</button>
       
   </form>
</div>



@endsection