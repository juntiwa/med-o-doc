<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'ค้นหาเอกสาร')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
{!! Toastr::message() !!}
<section id="formEdit">
   <form class="space-y-6 mx-40" action="{{ route('manage.update',$user->org_id) }}" method="post">
      @csrf
       <h5 class="text-xl font-medium text-gray-900">แก้ไขข้อมูลผู้ใช้งาน</h5>
       <div class="grid grid-cols-2 gap-4">
         <div>
            <label for="org_id" class="block mb-2 text-base font-medium text-gray-900">รหัสพนักงาน <span class="text-rose-600">*</span></label>
            <input type="text" name="org_id" id="org_id" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="รหัสพนักงาน" value="{{$user->org_id}}" required>
        </div>
         <div>
            <label for="login" class="block mb-2 text-base font-medium text-gray-900">ชื่อผู้ใช้งาน</label>
            <input type="text" name="login" id="login" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="ชื่อผู้ใช้งาน" readonly value="{{$user->username}}">
        </div>
       </div>
       
       <div class="grid grid-cols-2 gap-4">
         <div>
            <label for="full_name" class="block mb-2 text-base font-medium text-gray-900">ชื่อ สกุล </label>
            <input type="text" name="full_name" id="full_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" placeholder="ชื่อ นามสกุล" readonly value="{{$user->full_name}}">
        </div>
        <div>
         <label for="office_name" class="block mb-2 text-base font-medium text-gray-900">หน่วยงาน <span class="text-rose-600">*</span></label>
         <select name="office_name" id="office_name" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
         focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 " required>
          <option selected value="">เลือกหน่วยงานของคุณ</option>
          @foreach ($units as $unit)
             <option value="{{$unit->unitid}}" {{ ($user->office_name == $unit->unitname ? "selected": "") }}> {{$unit->unitname}} </option>
          @endforeach
        </select>
       </div>
       </div>
       <div class="grid grid-cols-2 gap-4">
         <div>
            <label for="is_admin" class="block mb-2 text-base font-medium text-gray-900">สิทธิ์ผู้ใช้งาน <span class="text-rose-600">*</span></label>
            <select name="is_admin" id="is_admin" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" required>
             <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
             <option value="1" {{ ($user->is_admin == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
             <option value="0" {{ ($user->is_admin == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
           </select>
        </div>
        <div>
          <label for="status" class="block mb-2 text-base font-medium text-gray-900">สถานะการใช้งาน <span class="text-rose-600">*</span></label>
          <select name="status" id="status" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg 
            focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5" required>
             <option value="" selected>---- เลือกสถานะการใช้งาน ----</option>
             <option value="Active" {{ ($user->status == "Active" ? "selected": "") }}>Active</option>
             <option value="Disable" {{ ($user->status == "Disable" ? "selected": "") }}>Disable</option>
           </select>
        </div>
       </div>
       
        <button type="submit" class="w-full text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none 
       focus:ring-teal-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">บันทึกการแก้ไขข้อมูล</button>
       
   </form>
</section>
@endsection