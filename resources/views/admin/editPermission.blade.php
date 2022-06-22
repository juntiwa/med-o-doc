@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<form action="{{route('permission.update', $user->org_id)}}" class="mt-6" method="POST">
   @csrf
   <!-- component -->
   <div class="text-slate-900 text-base px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
      <div class="-mx-3 md:flex mb-6">
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-last-name">
               SAPID <span class="text-red-500">*</span>
            </label>
            <input class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" name="sapid" id="grid-first-name" type="text" value="{{ $user->org_id}}">
         </div>
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-last-name">
               ชื่อผู้ใช้
            </label>
            <input disabled class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" name="username" id="grid-first-name" type="text" value="{{ $user->username}}">
         </div>
         <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-first-name">
               ชื่อ สกุล
            </label>
            <input disabled name="full_name" class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" id="grid-first-name" type="text" value="{{ $user->full_name}}">
         </div>
      </div>

      <div class="-mx-3 md:flex mb-6">
         <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-first-name">
               หน่วยงาน
            </label>
            <select name="office_name" id="office_name" class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" required>
             <option selected value="">เลือกหน่วยงานของคุณ</option>
             @foreach ($units as $unit)
             @if($user->office_name == $unit->unitname)
             <option value="{{$unit->unitid}}" selected> {{$unit->unitname}} </option>
             @else
             <option value="{{$unit->unitid}}"> {{$unit->unitname}} </option>

             @endif
             @endforeach
               
           </select>
         </div>
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-state">
               สิทธิ์การใช้งาน <span class="text-red-500">*</span>
            </label>
            <div class="relative">
               <select name="role" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                  <option value="1" {{ old('role', $user->is_admin) == 1 ? 'selected' : '' }}>Admin</option>
                  <option value="0" {{ old('role', $user->is_admin) == 0 ? 'selected' : '' }}>User</option>
               </select>
            </div>
         </div>
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-base font-bold mb-2" for="grid-state">
               สถานะ <span class="text-red-500">*</span>
            </label>
            <div class="relative">
               <select name="status" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                  <option value="Active" {{ old('status', $user->status) == "Active" ? 'selected' : '' }}>Active</option>
                  <option value="Disable" {{ old('status', $user->status) == "Disable" ? 'selected' : '' }}>Disable</option>
               </select>
            </div>
         </div>
      </div>

      <div class="-mx-3 md:flex mb-2">
         <div class="md:w-1/2 px-3 mb-6 md:mb-0"></div>
         <div class="md:w-1/2 px-3"></div>
         <div class="md:w-1/2 px-3 flex justify-end">
            <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-base leading-tight 
         uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none 
         focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">บันทึกข้อมูล</button>
         </div>
      </div>
   </div>
</form>


@endsection