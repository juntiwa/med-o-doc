<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'ค้นหาเอกสาร')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
<form action="{{route('manage.store')}}" method="post">
   @csrf
   <section id="inputform" class="grid grid-cols-1 lg:grid-cols-2 gap4">
      <section id="user1" class="grid grid-cols-1 lg:grid-cols-2 gap4">
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b class="text-rose-600">*</b></span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid1" id="sapid1" value="{{old('sapid1')}}" required
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username1" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>
            </label>
            <select disabled required name="permission1" id="permission1" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission1") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission1") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage1'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage1') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="user2" class="grid grid-cols-1 lg:grid-cols-2 gap4 hidden">
         <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID</span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid2" id="sapid2" value="{{old('sapid2')}}"
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username2" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน</span>
            </label>
            <select disabled name="permission2" id="permission2" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission2") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission2") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage2'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage2') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="user3" class="grid grid-cols-1 lg:grid-cols-2 gap4 hidden">
         <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID</span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid3" id="sapid3" value="{{old('sapid3')}}"
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username3" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน</span>
            </label>
            <select disabled name="permission3" id="permission3" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission3") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission3") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage3'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage3') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="user4" class="grid grid-cols-1 lg:grid-cols-2 gap4 hidden">
         <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID</span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid4" id="sapid4" value="{{old('sapid4')}}"
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username4" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน</span>
            </label>
            <select disabled name="permission4" id="permission4" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission4") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission4") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage4'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage4') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="user5" class="grid grid-cols-1 lg:grid-cols-2 gap4 hidden">
         <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID</span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid5" id="sapid5" value="{{old('sapid5')}}"
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username5" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน</span>
            </label>
            <select disabled name="permission5" id="permission5" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission5") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission5") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage5'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage5') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="user6" class="grid grid-cols-1 lg:grid-cols-2 gap4 hidden">
         <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID</span>
            </label>
            <input type="text" placeholder="กรอกรหัสพนักงาน" name="sapid6" id="sapid6" value="{{old('sapid6')}}"
            class="input input-bordered w-full max-w-xs bg-white border-slate-400 text-lg font-medium" />
            <input type="text" id="username6" class="input input-bordered w-full max-w-xs disabled:bg-white disabled:border-white text-lg font-medium" placeholder="ชื่อผู้ใช้งาน" disabled>
          </div>
          <div class="form-control w-full max-w-xs">
            <label class="label">
              <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน</span>
            </label>
            <select disabled name="permission6" id="permission6" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal">
              <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
              <option value="1" {{ (old("permission6") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
              <option value="0" {{ (old("permission6") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
            </select>
            @if($errors->has('massage6'))
             <div class="alert alert-error shadow-lg mt-2">
               <div>
                 <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                 </svg>
                 <span class="text-base">{{ $errors->first('massage6') }}</span>
               </div>
             </div>
            @endif
          </div>
      </section>
   
      <section id="buttonSubmit" class="flex w-full justify-end items-end col-span-2">
         <button type="submit" class="text-white bg-sky-600 hover:bg-sky-700 py-2 px-3 rounded-md">บันทึกข้อมูล</button>
      </section>
   </section>
</form>

<script src="{{asset('js/adduser.js')}}"></script>
@endsection