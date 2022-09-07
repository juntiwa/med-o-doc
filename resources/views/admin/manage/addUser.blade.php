

@extends('layouts.app')

@section('title', 'ค้นหาเอกสาร')

@section('sidebar')
    @parent

    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection

@section('content')
{!! Toastr::message() !!}
<div class="flex justify-center ml-3">
   <div>
      {{-- <p id="test-error" class="text-lg text-red-500 hidden">test กรุณาตรวจสอบข้อมูล</p> --}}
      <p id="errors"  class="flex text-lg text-red-500 hidden">
         <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 fill-red-500 mr-2" viewBox="0 0 24 24">
            <path d="M12,16a1,1,0,1,0,1,1A1,1,0,0,0,12,16Zm10.67,1.47-8.05-14a3,3,0,0,0-5.24,0l-8,14A3,3,0,0,0,3.94,22H20.06a3,3,0,0,0,2.61-4.53Zm-1.73,2a1,1,0,0,1-.88.51H3.94a1,1,0,0,1-.88-.51,1,1,0,0,1,0-1l8-14a1,1,0,0,1,1.78,0l8.05,14A1,1,0,0,1,20.94,19.49ZM12,8a1,1,0,0,0-1,1v4a1,1,0,0,0,2,0V9A1,1,0,0,0,12,8Z"/>
         </svg>
         กรุณาตรวจสอบข้อมูล
      </p>
   </div>
  {{--  <button type="button" name="plus_icon" id="plus_icon" class="flex items-center justify-center text-white bg-teal-600 hover:bg-teal-700 py-2 px-3 rounded-md">
      <svg id="plas_svg" xmlns="http://www.w3.org/2000/svg" class="cursor-pointer fill-white" weight="40" height="40" viewBox="0 0 24 24">
         <path d="M12,2A10,10,0,1,0,22,12,10,10,0,0,0,12,2Zm0,18a8,8,0,1,1,8-8A8,8,0,0,1,12,20Zm4-9H13V8a1,1,0,0,0-2,0v3H8a1,1,0,0,0,0,2h3v3a1,1,0,0,0,2,0V13h3a1,1,0,0,0,0-2Z"/>
      </svg>
      เพิ่มช่องกรอกข้อมูล
   </button> --}}
</div>
<section id="formAddUser">
   <form action="{{route('manage.store')}}" method="post">
      @csrf
      {{-- <section id="newuser" class="grid grid-cols-1 lg:grid-cols-2 gap-8"> --}}

      <section id="newuser" class="flex justify-center">
         <section id="user" class="lg:w-3/6 w-full">
            <div class="card-body">
                <h2 class="text-slate-900 text-xl font-semibold">เพิ่มผู้ใช้งาน</h2>
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b
                              class="text-rose-600">*</b></span>
                    </label>
                    <input type="text" placeholder="99999999" pattern="[0-9]+" minlength="8" maxlength="8" name="sapid[]"
                        id="sapid0" required class="input input-bordered w-full bg-white border-slate-400 text-lg font-medium"
                        data-user-index="0" />
                    <input id="username0" type="text" placeholder="ชื่อผู้ใช้งาน"
                        class="mt-3 input w-full h-auto max-w-lg text-base disabled:border-none disabled:bg-white disabled:text-slate-900"
                        disabled />
                </div>
                <div class="form-control w-full mr-4">
                    <label class="label">
                        <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b
                                class="text-rose-600">*</b></span>
                    </label>
                    <select disabled required name="permission[]" id="permission0"
                        class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal w-full">
                        <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
                        <option value="1">ผู้ดูแลระบบ</option>
                        <option value="0">ผู้ใช้งานทั่วไป</option>
                    </select>
                </div>
                <div class="form-control w-full mr-4">
                    <label class="label">
                        <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>
                    </label>
                    <select disabled required name="office_name[]" id="office_name0"
                        class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal w-full">
                        <option value="" selected>---- เลือกหน่วยงาน ----</option>
                       @foreach ($units as $unit)
                       <option value="{{$unit->unitname}}">{{$unit->unitname}}</option>
                       @endforeach

                    </select>
                </div>

                <div class="card-actions mt-5 justify-end">
                    <input type="submit" id="saveButton" value="บันทึกข้อมูล"
                        class="text-white bg-sky-600 hover:bg-sky-700 disabled:bg-slate-300 disabled:cursor-not-allowed py-2 px-3 rounded-md">
                </div>
            </div>
            {{-- <div class="card w-full bg-base-100 drop-shadow-lg bg-white">
              <div class="card-body">
                <h2 class="text-slate-900 text-xl font-semibold">เพิ่มผู้ใช้งาน</h2>
                <div class="form-control w-full">
                     <label class="label">
                        <span class="label-text text-slate-900 text-lg font-medium">รหัสพนักงาน SAPID <b class="text-rose-600">*</b></span>
                     </label>
                     <input type="text" placeholder="99999999" pattern="[0-9]+" minlength="8" maxlength="8" name="sapid[]" id="sapid0"
                        required class="input input-bordered w-full bg-white border-slate-400 text-lg font-medium"
                        data-user-index="0" />
                     <input id="username0" type="text" placeholder="ชื่อผู้ใช้งาน" class="mt-3 input w-full max-w-lg text-base disabled:border-none disabled:bg-white disabled:text-slate-900" disabled />
               </div>
               <div class="form-control w-full mr-4">
                  <label class="label">
                     <span class="label-text text-slate-900 text-lg font-medium">สิทธิ์ผู้ใช้งาน <b class="text-rose-600">*</b></span>
                  </label>
                  <select disabled required name="permission[]" id="permission0" class="select select-bordered disabled:bg-slate-200 bg-white border-slate-400 text-lg font-normal w-full">
                     <option value="" selected>---- เลือกสิทธิ์ผู้ใช้งาน ----</option>
                     <option value="1" {{ (old("permission") == "1" ? "selected": "") }}>ผู้ดูแลระบบ</option>
                     <option value="0" {{ (old("permission") == "0" ? "selected": "") }}>ผู้ใช้งานทั่วไป</option>
                  </select>
               </div>

                <div class="card-actions mt-5 justify-end">
                  <button type="button" id="remove" class="btn bg-red-500 border-none hover:bg-red-700" disabled>ลบช่องกรอกข้อมูล</button>
                    </div>
              </div>
            </div> --}}
         </section>
      </section>

      <section id="newuser"></section>

   </form>
</section>

   <script type="text/javascript">
      let sapidroute = "{{route('check.sapid.show')}}";
      let existuser = "{{route('exist.user')}}"
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   </script>
   <script type="text/javascript" src="{{asset(mix('js/manageuser.js'))}}"></script>
   <script type="text/javascript" src="{{asset(mix('js/adduser.js'))}}"></script>
   <script type="text/javascript" src="{{asset(mix('js/checkInvalidUser.js'))}}"></script>
   @endsection
