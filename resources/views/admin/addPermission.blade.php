@extends('layouts.app')
@section('title', 'เพิ่มข้อมูลสิทธิ์การเข้าถึง')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<form action="{{route('permission.store')}}" method="POST">
   @csrf
   <div id="InputGroup" class="grid lg:grid-cols-2 grid-cols-1 gap-4 ">
      <div id="InputDiv" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1 ">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 1<span class="text-lg text-red-600">*</span></label>
            <input required type="text" name="sapid" id="sapid" placeholder="กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white 
               focus:border-blue-600 focus:outline-none" pattern="[0-9]+" value="{{ old('sapid') }}">

            @if ($errors->has('user'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง <span class="text-lg text-red-600">*</span></label>
            <select required name="permis" id="permis" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
      <div id="InputDiv1" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1 ">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 2</label>
            <input type="text" name="sapid1" id="sapid1" placeholder=" กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
               focus:outline-none" value="{{ old('sapid1') }}">
            @if ($errors->has('user1'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user1') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis1" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select name="permis1" id="permis1" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
      <div id="InputDiv2" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1 ">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid2" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 3</label>
            <input type="text" name="sapid2" id="sapid2" placeholder=" กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
               focus:outline-none" value="{{ old('sapid2') }}">
            @if ($errors->has('user2'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user2') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis2" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select name="permis2" id="permis2" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
      <div id="InputDiv3" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1 ">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid3" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 4</label>
            <input type="text" name="sapid3" id="sapid3" placeholder=" กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
               focus:outline-none" value="{{ old('sapid3') }}">
            @if ($errors->has('user3'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user3') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis3" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select name="permis3" id="permis3" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
      <div id="InputDiv4" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1 ">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid4" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 5</label>
            <input type="text" name="sapid4" id="sapid4" placeholder=" กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
               focus:outline-none" value="{{ old('sapid4') }}">
            @if ($errors->has('user4'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user4') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis4" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select name="permis4" id="permis4" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
               <option value="1">ผู้ดูแลระบบ</option>
               <option value="0">ผู้ใช้งานทั่วไป</option>
            </select>
         </div>
      </div>
      <div id="InputDiv5" class="lg:flex lg:justify-start md:flex md:justify-start sm:grid sm:grid-cols-1">
         <div class="mb-3 xl:w-96 pr-10">
            <label for="sapid5" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">ผู้ใช้งาน 6</label>
            <input type="text" name="sapid5" id="sapid5" placeholder=" กรอกรหัสพนักงาน SAPID" class=" form-control 
               block w-full px-3  py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid 
               border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600
               focus:outline-none" value="{{ old('sapid5') }}">
            @if ($errors->has('user5'))
            <div class="alert alert-error shadow-sm w-fit mt-3 mb-3">
               <div>
                  <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  <span>{{ $errors->first('user5') }}</span>
               </div>
            </div>
            @endif
         </div>
         <div class="mb-3 xl:w-96 pr-10">
            <label for="permis5" class="form-label inline-block mb-2 text-gray-700 text-base font-normal">สิทธิ์เข้าถึง</label>
            <select name="permis5" id="permis5" class="form-select appearance-none block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition  ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
               <option selected value="">--- เลือกสิทธิ์ของผู้ใช้งาน ---</option>
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
   $("#InputDiv1").hide();
   $("#InputDiv2").hide();
   $("#InputDiv3").hide();
   $("#InputDiv4").hide();
   $("#InputDiv5").hide();
   $(document).ready(function() {
      $('#permis').change(function() {
         let permis = $(this).val();
         // console.log(permis)
         if (permis !== '') {
            $("#InputDiv1").show();
         } else {
            $("#InputDiv1").hide();
         }
      });
      $('#permis1').change(function() {
         let permis = $(this).val();
         // console.log(permis)
         if (permis !== '') {
            $("#InputDiv2").show();
         } else {
            $("#InputDiv2").hide();
         }
      });
      $('#permis2').change(function() {
         let permis = $(this).val();
         // console.log(permis)
         if (permis !== '') {
            $("#InputDiv3").show();
         } else {
            $("#InputDiv3").hide();
         }
      });
      $('#permis3').change(function() {
         let permis = $(this).val();
         // console.log(permis)
         if (permis !== '') {
            $("#InputDiv4").show();
         } else {
            $("#InputDiv4").hide();
         }
      });
      $('#permis4').change(function() {
         let permis = $(this).val();
         // console.log(permis)
         if (permis !== '') {
            $("#InputDiv5").show();
         } else {
            $("#InputDiv5").hide();
         }
      });

      // requiered
      $('input[name=sapid1]').change(function() {
         let sapid1 = $(this).val();
         // console.log(sapid1)
         if (sapid1 !== '') {
            $('#permis1').prop('required', true);
         } else {
            $('#permis1').val('');
            $('#permis1').prop('required', false);
            $("#InputDiv2").hide();
         }
      });

      var sapid1 = '{{ old("sapid1") }}';
      if (sapid1 !== '') {
         $('#permis1').prop('required', true);
      }

      $('input[name=sapid2]').change(function() {
         let sapid2 = $(this).val();
         // console.log(sapid2)
         if (sapid2 !== '') {
            $('#permis2').prop('required', true);
         } else {
            $('#permis2').val('');
            $('#permis2').prop('required', false);
            $("#InputDiv3").hide();
         }
      });

      var sapid2 = '{{ old("sapid2") }}';
      if (sapid2 !== '') {
         $('#permis2').prop('required', true);
      }

      $('input[name=sapid3]').change(function() {
         let sapid3 = $(this).val();
         // console.log(sapid3)
         if (sapid3 !== '') {
            $('#permis3').prop('required', true);
         } else {
            $('#permis3').val('');
            $('#permis3').prop('required', false);
            $("#InputDiv4").hide();
         }
      });

      var sapid3 = '{{ old("sapid3") }}';
      if (sapid3 !== '') {
         $('#permis3').prop('required', true);
      }

      $('input[name=sapid4]').change(function() {
         let sapid4 = $(this).val();
         // console.log(sapid4)
         if (sapid4 !== '') {
            $('#permis4').prop('required', true);
         } else {
            $('#permis4').val('');
            $('#permis4').prop('required', false);
            $("#InputDiv5").hide();
         }
      });

      var sapid4 = '{{ old("sapid4") }}';
      if (sapid4 !== '') {
         $('#permis4').prop('required', true);
      }

      $('input[name=sapid5]').change(function() {
         let sapid5 = $(this).val();
         // console.log(sapid5)
         if (sapid5 !== '') {
            $('#permis5').prop('required', true);
         } else {
            $('#permis5').val('');
            $('#permis5').prop('required', false);
         }
      });

      var sapid5 = '{{ old("sapid5") }}';
      if (sapid5 !== '') {
         $('#permis5').prop('required', true);
      }

      // old permis
      var permis = '{{ old("permis") }}';
      if (permis !== '') {
         $('#permis').val(permis);
         $("#permis").change();
      }

      // old permis1
      var permis1 = '{{ old("permis1") }}';
      if (permis1 !== '') {
         $('#permis1').val(permis1);
         $("#InputDiv1").show();
         $("#permis1").change();
      }

      // old permis2
      var permis2 = '{{ old("permis2") }}';
      if (permis2 !== '') {
         $('#permis2').val(permis2);
         $("#InputDiv2").show();
         $("#permis2").change();
      }

      // old permis3
      var permis3 = '{{ old("permis3") }}';
      if (permis3 !== '') {
         $('#permis3').val(permis3);
         $("#InputDiv3").show();
         $("#permis3").change();
      }

      // old permis4
      var permis4 = '{{ old("permis4") }}';
      if (permis4 !== '') {
         $('#permis4').val(permis4);
         $("#InputDiv4").show();
         $("#permis4").change();
      }

      // old permis5
      var permis5 = '{{ old("permis5") }}';
      if (permis5 !== '') {
         $('#permis5').val(permis5);
         $("#InputDiv5").show();
         $("#permis5").change();
      }
   });
</script>
@endsection