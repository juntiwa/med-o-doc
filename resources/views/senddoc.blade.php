@extends('layouts.app')
@section('title', 'ทะเบียนหนังสือส่ง')
@section('sidebar')
@parent
@endsection
@section('content')
{!! Toastr::message() !!}
<!-- Main content header -->
<div class="grid grid-rows-1 pb-3 space-y-4 border-b lg:items-center lg:space-y-0 lg:flex-row">
   <div class="lg:flex lg:justify-between md:flex md:justify-between md:space-x-3 sm:grid sm:grid-cols-1 mt-3">
      <!-- หัวข้อหน้าเว็บ -->
      <h1 class="text-2xl text-slate-900 font-semibold whitespace-normal">ทะเบียนหนังสือส่ง</h1>

      <!-- switch -->
      <div class="flex pt-2 ">
         <div class="bg-white">
            <div class="flex items-center justify-center space-x-2">
               <!-- <span class="text-sm text-gray-800 dark:text-gray-500">Light</span> -->
               <span class="mr-3 inline-block text-lg font-medium text-gray-900">ปิดช่องค้นหา</span>
               <label for="toggle-example-checked" class="flex relative items-center cursor-pointer m-0">
                  <input type="checkbox" id="toggle-example-checked" class="sr-only" checked>
                  <div class="w-11 h-6 bg-gray-200 rounded-full border border-gray-200 toggle-bg"></div>
               </label>
               <span class="ml-3 inline-block text-lg font-medium text-gray-900">แสดงช่องค้นหา</span>
               <!-- <span class="text-sm text-gray-400 dark:text-white">Dark</span> -->
            </div>
         </div>
      </div>
   </div>
</div>

<!-- from search -->
<div>
   <div class="collapse multi-collapse show" id="multiCollapseExample1">
      <!-- Start Content -->
      <form action="{{ route('send.search') }}" method="GET">
         <!-- @csrf -->
         <div class="grid grid-cols-1 gap-3 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-5">
            <!-- ชนิดหนังสือ -->
            <div class="mb-3 xl:w-full">
               <label for="sendtype" class="form-label inline-block mb-2 text-lg text-gray-800 font-medium">ชนิดหนังสือ</label>
               <select name="sendtype" id="sendtype" class="form-select appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
               rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                  <option value="" selected disabled>เลือกชนิดหนังสือ</option>
                  @foreach($types as $type)
                  <option value="{{ $type->typeid }}">{{ $type->typename }}</option>
                  @endforeach
               </select>
            </div>

            <!-- จาก -->
            <div class="mb-3 xl:w-full">
               <label for="sendfrom" class="form-label inline-block mb-2 text-lg text-gray-800 font-medium">จาก</label>

               <select name="ssendfrom" id="ssendfrom" class="form-select appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
               rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                  <option value="">เลือกหน่วยงานที่ส่ง</option>
               </select>

               <input type="text" name="isendfrom" id="isendfrom" class=" form-control appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
               rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 
               focus:outline-none" aria-label="Default select example " placeholder="ส่งจาก" value="{{ old('isendfrom') }}">

            </div>

            <!-- ถึง -->
            <div class="mb-3 xl:w-full">
               <label for="sendto" class="form-label inline-block mb-2 text-lg text-gray-800 font-medium">ถึง</label>
               <select name="ssendto" id="ssendto" class="form-select appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
               rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                  <option value="">เลือกหน่วยงานที่รับ</option>
               </select>

               <input type="text" name="isendto" id="isendto" class="form-control appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
               rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 
               focus:outline-none " aria-label="Default select example" placeholder="ส่งถึง" value="{{ old('isendto') }}">
            </div>

            <!-- หัวเรื่อง -->
            <div class="mb-3 xl:w-full md:col-span-1 lg:col-span-2">
               <label for="sregtitle" class="form-label inline-block mb-2 text-lg text-gray-800 font-medium">หัวเรื่อง<span class=" text-red-500 text-base ml-1">*</span></label>
               <input type="text" name="sregtitle" id="sregtitle" class=" form-control appearance-none block w-full 
                        px-3 py-1.5 text-lg text-gray-800 font-medium disabled:bg-slate-100 
                        required:bg-white rounded transition ease-in-out m-0 required:border-red-600
                        focus:text-gray-700 focus:bg-white focus:border-red-600
                        focus:outline-none " aria-label="Default select example" placeholder="หัวเรื่อง" required value="{{ old('sregtitle') }}">
            </div>

            <!-- ลงทะเบียนเมื่อ -->
            <div class="mb-3 xl:w-full md:col-span-2 lg:col-span-4">
               <label for="send" class="form-label inline-block mb-2 text-lg text-gray-800 font-medium">ส่งเมื่อ</label>
               <div class="grid grid-cols-5 gap-4 ">

                  <select name="sfrommonth" id="sfrommonth" class="form-select appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
                        rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                     <!-- <option>เดือน</option> -->
                     <option value="" selected>เดือน</option>
                     <option value="1">มกราคม</option>
                     <option value="2">กุมภาพันธ์</option>
                     <option value="3">มีนาคม</option>
                     <option value="4">เมษายน</option>
                     <option value="5">พฤษภาคม</option>
                     <option value="6">มิถุนายน</option>
                     <option value="7">กรกฎาคม</option>
                     <option value="8">สิงหาคม</option>
                     <option value="9">กันยายน</option>
                     <option value="10">ตุลาคม</option>
                     <option value="11">พฤศจิกายน</option>
                     <option value="12">ธันวาคม</option>
                  </select>

                  <select name="sfromyear" id="sfromyear" class="form-select appearance-none block w-full px-3 py-1.5 text-lg text-gray-800 font-medium bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300
                        rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" aria-label="Default select example">
                     <option value="" selected>ปี</option>
                     @foreach($sendyears as $sendyear)
                     @if($sendyear->sendyear == "0000")
                     @else
                     <option value="{{$sendyear->sendyear}}">
                        {{ $sendyear->sendyear + 543 }}
                     </option>
                     @endif
                     @endforeach
                  </select>

                  <span class=" flex justify-center items-center text-lg text-gray-800 font-medium">ถึง</span>

                  <select disabled name="stomonth" id="stomonth" class="form-select appearance-none block w-full 
                        px-3 py-1.5 text-lg text-gray-800 font-medium disabled:bg-slate-100 disabled:border-slate-200
                        required:bg-white rounded transition ease-in-out m-0 required:border-red-600
                        focus:text-gray-700 focus:bg-white focus:border-red-600
                        focus:outline-none" aria-label="Default select example">
                     <!-- <option>เดือน</option> -->
                     <option value="" selected disabled>เดือน</option>
                     <option value="1">มกราคม</option>
                     <option value="2">กุมภาพันธ์</option>
                     <option value="3">มีนาคม</option>
                     <option value="4">เมษายน</option>
                     <option value="5">พฤษภาคม</option>
                     <option value="6">มิถุนายน</option>
                     <option value="7">กรกฎาคม</option>
                     <option value="8">สิงหาคม</option>
                     <option value="9">กันยายน</option>
                     <option value="10">ตุลาคม</option>
                     <option value="11">พฤศจิกายน</option>
                     <option value="12">ธันวาคม</option>
                  </select>

                  <select disabled name="stoyear" id="stoyear" class="form-select appearance-none block w-full 
                        px-3 py-1.5 text-lg text-gray-800 font-medium disabled:bg-slate-100 disabled:border-slate-200
                        required:bg-white rounded transition ease-in-out m-0 required:border-red-600
                        focus:text-gray-700 focus:bg-white focus:border-red-600
                        focus:outline-none" aria-label="Default select example">
                     <option value="" selected disabled>ปี</option>
                     @foreach($sendyears as $sendyear)
                     @if($sendyear->sendyear == "0000")
                     @else
                     <option value="{{$sendyear->sendyear}}">
                        {{ $sendyear->sendyear + 543 }}
                     </option>
                     @endif
                     @endforeach
                  </select>
               </div>
            </div>

            <!-- button -->
            <div class=" mb-3 xl:w-full md:col-span-1 md:pt-10 lg:pt-0">
               <div class=" grid grid-cols-2 gap-4 text-lg font-light whitespace-normal">
                  <div class="grid col-span-1 gap-4">
                     <button type="submit" class="inline-block px-4 py-2 bg-green-500 text-white 
                     leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg 
                     focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out lg:mt-10 ">ค้นหา</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>

<!-- ตาราง -->
<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-80 lg:w-96 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">หัวเรื่อง</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ชนิดหนังสือ</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">จาก</th>
            <th class="w-36 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ถึง</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">ส่งวันที่</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">รับวันที่</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">เอกสารแนบ1</th>
            <th class="w-16 p-3 text-base text-gray-800 font-semibold tracking-wide text-center">เอกสารแนบ2</th>
         </tr>
      </thead>
      <!-- ยังไม่ค้นหา -->
      @if(isset($sends))
      <tbody class="divide-y divide-gray-100">
         @if(count($sends)>0)
         @foreach($sends as $send)
         <tr class="bg-white">
            <!-- หัวเรื่อง -->
            <td class="p-3 text-base text-blue-500 font-medium align-text-top">
               @if ($send->regtitle == null )
               ไม่ระบุ
               @else
               {{$send->regtitle}}
               @endif
            </td>
            <!-- ชนิดหนังสือ -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-normal flex justify-center">
               <!-- join types show typename -->
               @if ($send->sendtype == null )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg 
                        bg-opacity-50 text-center">ไม่ระบุ</span>
               @else
               @if ($send->types['typeid'] == 0 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50 text-center">{{$send->types['typename']}}</span>
               @elseif ($send->types['typeid'] == 3 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50 text-center">{{$send->types['typename']}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg 
                        bg-opacity-50 text-center">อื่น ๆ</span>
               @endif
               @endif
            </td>
            <!-- จาก -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               <!-- ตรวจสอบค่าว่า sendunitid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
               @if ($send->sendunitid == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
               @else
               <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
               @if ($send->sendtype == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
               @else
               <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
               @if ($send->sendtype == 0 )
               <!-- loop ในภาค จากหน่วยใด -->
               @foreach($send->fromins as $fromins)
               {{$fromins->unitname}}
               <!-- endforeach fromins -->
               @endforeach
               <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
               @elseif ($send->regtype == 3 )
               <!-- loop นอกภาค จากหน่วยใด -->
               @foreach($send->fromouts as $fromouts)
               {{$fromouts->unitname}}
               <!-- endforeach fromouts -->
               @endforeach
               <!-- ถ้า sendtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
               @else
               อื่น ๆ
               <!-- endif sendtype ในหรือนอกภาค -->
               @endif
               <!-- endif sendtype = null-->
               @endif
               <!-- endif sendunitid = null-->
               @endif
            </td>
            <!-- ถึง -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               <!-- ตรวจสอบค่าว่า sendtoid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
               @if ($send->sendtoid == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
               @else
               <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
               @if ($send->sendtype == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
               @else
               <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
               @if ($send->sendtype == 0 )
               <!-- loop ในภาค จากหน่วยใด -->
               @foreach($send->toins as $toins)
               {{$toins->unitname}}
               <!-- endforeach toins -->
               @endforeach
               <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
               @elseif ($send->sendtype == 3 )
               <!-- loop นอกภาค จากหน่วยใด -->
               @foreach($send->toouts as $toouts)
               {{$toouts->unitname}}
               <!-- endforeach toouts -->
               @endforeach
               <!-- ถ้า regtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
               @else
               อื่น ๆ
               <!-- endif sendtype ในหรือนอกภาค -->
               @endif
               <!-- endif sendtype = null-->
               @endif
               <!-- endif sendtoid = null-->
               @endif
            </td>
            <!-- ส่งวันที่ -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top lg:text-center">
               @if ($send->senddate == "0000-00-00" || null )
               ไม่ระบุ
               @else
               {{$send->thaidate()}}
               @endif
            </td>
            <!-- รับวันที่ -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top lg:text-center">
               @if ($send->recdate == "0000-00-00" || null )
               ไม่ระบุ
               @else
               {{$send->thairecdate()}}
               @endif
            </td>
            <!-- เอกสารแนบ1 -->
            <td class="p-3 text-base text-gray-800 font-medium">
               @if ($send->regdoc == null)
               <p class="grid justify-items-center ">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
                  -
               </p>
               @else

               <a href="{{$send->senddoc_url}}" target=" _blank" class="grid justify-items-center">
                  @if (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'pdf')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'doc')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                  </svg>

                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xls' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                  </svg>
                  @endif
               </a>
               @endif

            </td>
            <!-- เอกสารแนบ2 -->
            <td class="p-3 text-base text-gray-800 font-medium">
               @if ($send->regdoc2 == null)
               <p class="grid justify-items-center ">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
                  -
               </p>
               @else
               <a href="{{$send->senddoc2_url}}" target=" _blank" class="grid justify-items-center">
                  @if (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'pdf')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'doc')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                  </svg>

                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xls' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                  </svg>
                  @endif
               </a>
               @endif

            </td>
         </tr>
         @endforeach
         @else
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium whitespace-normal">
               <p class="font-bold text-red-600">
                  ไม่พบข้อมูล
               </p>
            </td>
         </tr>
         @endif
      </tbody>
      @endif

      <!-- ค้นหา -->
      @if(isset($searchsends))
      <tbody class="divide-y divide-gray-100">
         @if(count($searchsends)>0)
         @foreach($searchsends as $send)
         <tr class="bg-white">
            <!-- หัวเรื่อง -->
            <td class="p-3 text-base text-blue-500 font-medium align-text-top">
               @if ($send->regtitle == null )
               ไม่ระบุ
               @else
               {{$send->regtitle}}
               @endif
            </td>
            <!-- ชนิดหนังสือ -->
            <td class="p-3 text-base text-gray-800 font-medium whitespace-normal flex justify-center">
               <!-- join types show typename -->
               @if ($send->sendtype == null )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg 
                        bg-opacity-50 text-center">ไม่ระบุ</span>
               @else
               @if ($send->types['typeid'] == 0 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50 text-center">{{$send->types['typename']}}</span>
               @elseif ($send->types['typeid'] == 3 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50 text-center">{{$send->types['typename']}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg 
                        bg-opacity-50 text-center">อื่น ๆ</span>
               @endif
               @endif
            </td>
            <!-- จาก -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               <!-- ตรวจสอบค่าว่า sendunitid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
               @if ($send->sendunitid == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
               @else
               <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
               @if ($send->sendtype == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
               @else
               <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
               @if ($send->sendtype == 0 )
               <!-- loop ในภาค จากหน่วยใด -->
               @foreach($send->fromins as $fromins)
               {{$fromins->unitname}}
               <!-- endforeach fromins -->
               @endforeach
               <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
               @elseif ($send->regtype == 3 )
               <!-- loop นอกภาค จากหน่วยใด -->
               @foreach($send->fromouts as $fromouts)
               {{$fromouts->unitname}}
               <!-- endforeach fromouts -->
               @endforeach
               <!-- ถ้า sendtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
               @else
               อื่น ๆ
               <!-- endif sendtype ในหรือนอกภาค -->
               @endif
               <!-- endif sendtype = null-->
               @endif
               <!-- endif sendunitid = null-->
               @endif
            </td>
            <!-- ถึง -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               <!-- ตรวจสอบค่าว่า sendtoid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
               @if ($send->sendtoid == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
               @else
               <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
               @if ($send->sendtype == null )
               ไม่ระบุ
               <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
               @else
               <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
               @if ($send->sendtype == 0 )
               <!-- loop ในภาค จากหน่วยใด -->
               @foreach($send->toins as $toins)
               {{$toins->unitname}}
               <!-- endforeach toins -->
               @endforeach
               <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
               @elseif ($send->sendtype == 3 )
               <!-- loop นอกภาค จากหน่วยใด -->
               @foreach($send->toouts as $toouts)
               {{$toouts->unitname}}
               <!-- endforeach toouts -->
               @endforeach
               <!-- ถ้า regtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
               @else
               อื่น ๆ
               <!-- endif sendtype ในหรือนอกภาค -->
               @endif
               <!-- endif sendtype = null-->
               @endif
               <!-- endif sendtoid = null-->
               @endif
            </td>
            <!-- ส่งวันที่ -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top lg:text-center">
               @if ($send->senddate == "0000-00-00" || null )
               ไม่ระบุ
               @else
               {{$send->thaidate()}}
               @endif
            </td>
            <!-- รับวันที่ -->
            <td class="p-3 text-base text-gray-800 font-medium align-text-top lg:text-center">
               @if ($send->recdate == "0000-00-00" || null )
               ไม่ระบุ
               @else
               {{$send->thairecdate()}}
               @endif
            </td>
            <!-- เอกสารแนบ1 -->
            <td class="p-3 text-base text-gray-800 font-medium">
               @if ($send->regdoc == null)
               <p class="grid justify-items-center ">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
                  -
               </p>
               @else

               <a href="{{$send->senddoc_url}}" target=" _blank" class="grid justify-items-center">
                  @if (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'pdf')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'doc')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                  </svg>

                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xls' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                  </svg>
                  @endif
               </a>
               @endif

            </td>
            <!-- เอกสารแนบ2 -->
            <td class="p-3 text-base text-gray-800 font-medium">
               @if ($send->regdoc2 == null)
               <p class="grid justify-items-center ">
                  <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
                  -
               </p>
               @else
               <a href="{{$send->senddoc2_url}}" target=" _blank" class="grid justify-items-center">
                  @if (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'pdf')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'doc')
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                  </svg>

                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xls' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
                  @else
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                     <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                     <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                  </svg>
                  @endif
               </a>
               @endif

            </td>
         </tr>
         @endforeach
         @else
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium whitespace-normal">
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
   @if(isset($sends))
   @if(count($sends)>0)
   @foreach($sends as $send)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">
      <div class="flex items-center space-x-2 text-base ">
         <!-- เลขที่หนังสือ -->
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               @if ($send->regid == null )
               ไม่ระบุ
               @else
               {{$send->regid}}
               @endif
            </p>
         </div>
      </div>
      <div class="flex text-base justify-between">
         <!-- ส่งวันที่ -->
         <div class="text-gray-700">
            @if ($send->senddate == "0000-00-00" || null )
            ไม่ระบุ
            @else
            {{$send->thaidate()}}
            @endif
         </div>
         <!-- ชนิดหนังสือ -->
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-normal">
               <!-- join types show typename -->
               @if ($send->sendtype == null )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg 
                        bg-opacity-50">ไม่ระบุ</span>
               @else
               @if ($send->types['typeid'] == 0 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50">{{$send->types['typename']}}</span>
               @elseif ($send->types['typeid'] == 3 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50">{{$send->types['typename']}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg 
                        bg-opacity-50">อื่น ๆ</span>
               @endif
               @endif
            </span>
         </div>
      </div>
      <!-- จาก -->
      <div class="flex text-gray-700">
         จาก :
         <!-- ตรวจสอบค่าว่า sendunitid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
         @if ($send->sendunitid == null )
         ไม่ระบุ
         <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
         @else
         <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
         @if ($send->sendtype == null )
         ไม่ระบุ
         <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
         @else
         <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
         @if ($send->sendtype == 0 )
         <!-- loop ในภาค จากหน่วยใด -->
         @foreach($send->fromins as $fromins)
         {{$fromins->unitname}}
         <!-- endforeach fromins -->
         @endforeach
         <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
         @elseif ($send->regtype == 3 )
         <!-- loop นอกภาค จากหน่วยใด -->
         @foreach($send->fromouts as $fromouts)
         {{$fromouts->unitname}}
         <!-- endforeach fromouts -->
         @endforeach
         <!-- ถ้า sendtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
         @else
         อื่น ๆ
         <!-- endif sendtype ในหรือนอกภาค -->
         @endif
         <!-- endif sendtype = null-->
         @endif
         <!-- endif sendunitid = null-->
         @endif
      </div>
      <!-- หัวเรื่อง -->
      <div class="text-base text-gray-700">
         เรื่อง :
         @if ($send->regtitle == null )
         ไม่ระบุ
         @else
         {{$send->regtitle}}
         @endif
      </div>

      <!-- เอกสารแนบ 1  -->
      <div class="flex text-base text-gray-700 pt-10">
         <div class="absolute left-3 bottom-3 min-h-max max-h-full ">
            @if ($send->regdoc == null)
            <p class="grid justify-items-center ">
               -
            </p>
            @else
            <a href="{{$send->senddoc_url}}" target=" _blank" class="grid justify-items-center">
               @if (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'pdf')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
               </svg>
               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'doc')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
               </svg>

               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xls' )
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
               </svg>
               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
               @else
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
               </svg>
               @endif
            </a>
            @endif

         </div>
         <div class="absolute left-16 bottom-3 min-h-max max-h-full ">
            @if ($send->regdoc2 == null)
            <p class="grid justify-items-center ">
               <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
               -
            </p>
            @else
            <a href="{{$send->senddoc2_url}}" target=" _blank" class="grid justify-items-center">
               @if (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'pdf')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
               </svg>
               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'doc')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
               </svg>

               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xls' )
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
               </svg>
               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
               @else
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
               </svg>
               @endif
            </a>
            @endif

         </div>
      </div>
   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif

   <!-- หลังค้นหา -->
   @if(isset($searchsends))
   @if(count($searchsends)>0)
   @foreach($searchsends as $send)
   <div class="bg-white space-y-3 p-4 rounded-lg shadow-sm relative">
      <div class="flex items-center space-x-2 text-base ">
         <!-- เลขที่หนังสือ -->
         <div>
            <p class="text-blue-500 text-base font-semibold hover:underline">
               @if ($send->regid == null )
               ไม่ระบุ
               @else
               {{$send->regid}}
               @endif
            </p>
         </div>
      </div>
      <div class="flex text-base justify-between">
         <!-- ส่งวันที่ -->
         <div class="text-gray-700">
            @if ($send->senddate == "0000-00-00" || null )
            ไม่ระบุ
            @else
            {{$send->thaidate()}}
            @endif
         </div>
         <!-- ชนิดหนังสือ -->
         <div>
            <span class="p-1.5 text-base font-medium uppercase tracking-wider whitespace-normal">
               <!-- join types show typename -->
               @if ($send->sendtype == null )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg 
                        bg-opacity-50">ไม่ระบุ</span>
               @else
               @if ($send->types['typeid'] == 0 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-green-800 bg-green-200 rounded-lg 
                        bg-opacity-50">{{$send->types['typename']}}</span>
               @elseif ($send->types['typeid'] == 3 )
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-red-800 bg-red-200 rounded-lg 
                        bg-opacity-50">{{$send->types['typename']}}</span>
               @else
               <span class="p-1.5 text-base font-medium uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg 
                        bg-opacity-50">อื่น ๆ</span>
               @endif
               @endif
            </span>
         </div>
      </div>
      <!-- จาก -->
      <div class="flex text-gray-700">
         จาก :
         <!-- ตรวจสอบค่าว่า sendunitid ถ้าเป็นค่า null แสดงว่าไม่ระบุ-->
         @if ($send->sendunitid == null )
         ไม่ระบุ
         <!-- ถ้าไม่เป็นค่า null ตรวจสอบข้อมูลต่อไป -->
         @else
         <!-- ตรวจสอบค่า sendtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
         @if ($send->sendtype == null )
         ไม่ระบุ
         <!-- ถ้าไม่เป็นค่า null ตรวจสอบค่าต่อไป -->
         @else
         <!-- ถ้า sendtype = 0 แสดงชื่อในภาค -->
         @if ($send->sendtype == 0 )
         <!-- loop ในภาค จากหน่วยใด -->
         @foreach($send->fromins as $fromins)
         {{$fromins->unitname}}
         <!-- endforeach fromins -->
         @endforeach
         <!-- ถ้า regtype = 3 แสดงชื่อนอกภาค -->
         @elseif ($send->regtype == 3 )
         <!-- loop นอกภาค จากหน่วยใด -->
         @foreach($send->fromouts as $fromouts)
         {{$fromouts->unitname}}
         <!-- endforeach fromouts -->
         @endforeach
         <!-- ถ้า sendtype นอกเหนือจาก 0 และ 3 แสดงอื่น ๆ -->
         @else
         อื่น ๆ
         <!-- endif sendtype ในหรือนอกภาค -->
         @endif
         <!-- endif sendtype = null-->
         @endif
         <!-- endif sendunitid = null-->
         @endif
      </div>
      <!-- หัวเรื่อง -->
      <div class="text-base text-gray-700">
         เรื่อง :
         @if ($send->regtitle == null )
         ไม่ระบุ
         @else
         {{$send->regtitle}}
         @endif
      </div>

      <!-- เอกสารแนบ 1  -->
      <div class="flex text-base text-gray-700 pt-10">
         <div class="absolute left-3 bottom-3 min-h-max max-h-full ">
            @if ($send->regdoc == null)
            <p class="grid justify-items-center ">
               -
            </p>
            @else
            <a href="{{$send->senddoc_url}}" target=" _blank" class="grid justify-items-center">
               @if (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'pdf')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
               </svg>
               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'doc')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
               </svg>

               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'xls' )
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
               </svg>
               @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
               @else
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
               </svg>
               @endif
            </a>
            @endif

         </div>
         <div class="absolute left-16 bottom-3 min-h-max max-h-full ">
            @if ($send->regdoc2 == null)
            <p class="grid justify-items-center ">
               <!-- <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-gray-400 " viewBox="0 0 384 512">
                     <path d="M0 64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V64zM336 448V160H256C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V448C48 456.8 55.16 464 64 464H320C328.8 464 336 456.8 336 448z" />
                  </svg> -->
               -
            </p>
            @else
            <a href="{{$send->senddoc2_url}}" target=" _blank" class="grid justify-items-center">
               @if (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'pdf')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
               </svg>
               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'doc')
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
               </svg>

               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'xls' )
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
               </svg>
               @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'rar' )
                  <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                     <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                  </svg>
                  @elseif (pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($send->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
                  <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                     <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                  </svg>
               @else
               <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                  <!--! Font Awesome Pro 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. -->
                  <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
               </svg>
               @endif
            </a>
            @endif

         </div>
      </div>
   </div>
   @endforeach
   @else
   <p class="text-red-500">ไม่พบข้อมูล</p>
   @endif
   @endif
</div>

<!-- pagination -->
@if(Route::is('send.search'))
<div class="col-md-12 mt-6 mb-6">
   {{ $searchsends->withQueryString()->links('pagination::tailwind') }}
</div>
@endif

<!-- Script -->
<script type="text/javascript">
   $('#isendfrom').addClass('hidden');
   $('#isendto').addClass('hidden');
   var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   $(document).ready(function() {
      $('#ssendfrom').prop('disabled', true);
      $('#ssendto').prop('disabled', true);
      $('#sendtype').change(function() {
         $('#ssendfrom').prop('disabled', false);
         $('#ssendto').prop('disabled', false);
         let typeid = parseInt($(this).val());
         // console.log(typeid);
         if (typeid == 0) {
            $('#ssendfrom').removeClass('hidden');
            $('#isendfrom').addClass('hidden');
            $('#ssendto').removeClass('hidden');
            $('#isendto').addClass('hidden');

            $('#isendfrom').val('');
            $('#isendto').val('');
            var ssendfrom = <?= json_encode($ssendfrom, JSON_HEX_TAG); ?>;

            jQuery("#ssendto").html('<option value="">เลือกหน่วยงานที่รับ</option>')
            jQuery.ajax({
               url: "{{route('send.select.from')}}",
               type: 'post',
               // data: 'typeid=' + typeid + '&_token={{csrf_token()}}',
               data: {
                  typeid: typeid,
                  ssendfrom: ssendfrom
               },
               success: function(result) {
                  jQuery('#ssendfrom').html(result)
               }
            });

            var ssendto = <?= json_encode($ssendto, JSON_HEX_TAG); ?>;
            jQuery.ajax({
               url: "{{route('send.select.to')}}",
               type: 'post',
               // data: 'typeid=' + typeid + '&_token={{csrf_token()}}',
               data: {
                  typeid: typeid,
                  ssendto: ssendto
               },
               success: function(result) {
                  jQuery('#ssendto').html(result)
               }
            });
         } else {
            $('#ssendfrom').addClass('hidden');
            $('#isendfrom').removeClass('hidden');
            $('#ssendto').addClass('hidden');
            $('#isendto').removeClass('hidden');
            $('#ssendfrom').val('');
            $('#ssendto').val('');

            $(document).ready(function() {
               $("#isendfrom").autocomplete({
                  source: function(request, response) {
                     // Fetch data
                     $.ajax({
                        url: "{{route('send.autocomplete')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                           _token: CSRF_TOKEN,
                           search: request.term
                        },
                        success: function(data) {
                           response(data);
                        }
                     });
                  },
                  select: function(event, ui) {
                     // Set selection
                     $('#isendfrom').val(ui.item.label); // display the selected text
                     // $('#idfrom').val(ui.item.value); // save selected id to input
                     return false;
                  }
               });

               $("#isendto").autocomplete({
                  source: function(request, response) {
                     // Fetch data
                     $.ajax({
                        url: "{{route('send.autocomplete')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                           _token: CSRF_TOKEN,
                           search: request.term
                        },
                        success: function(data) {
                           response(data);
                        }
                     });
                  },
                  select: function(event, ui) {
                     // Set selection
                     $('#isendto').val(ui.item.label); // display the selected text
                     // $('#idto').val(ui.item.value); // save selected id to input

                     return false;
                  }
               });
            });
         }
      });

      // toggle hide show  from input
      $("#toggle-example-checked").click(function() {
         $("#multiCollapseExample1").toggle("slow");
      });

      // old input sendtype
      var typeold = '{{ old("sendtype") }}';
      if (typeold !== '') {
         $('#sendtype').val(typeold);
         $("#sendtype").change();
      }

      // old input sfrommonth
      var sfrommonth = '{{ old("sfrommonth") }}';
      if (sfrommonth !== '') {
         $('#sfrommonth').val(sfrommonth);
         $("#stomonth > option").filter(function() {
            return $(this).attr("value") < sfrommonth
         }).prop('disabled', true);
      }
      // old input stomonth
      var stomonth = '{{ old("stomonth") }}';
      if (stomonth !== '') {
         $('#stomonth').val(stomonth);
         $('#stomonth').prop('required', true);
         $('#stomonth').prop('disabled', false);
      }
      // old input sfromyear
      var sfromyear = '{{ old("sfromyear") }}';
      if (sfromyear !== '') {
         $('#sfromyear').val(sfromyear);
         // console.log(sfromyear)
         $("#stoyear > option").filter(function() {
            return $(this).attr("value") < sfromyear
         }).prop('disabled', true);
      }
      // old input stoyear
      var stoyear = '{{ old("stoyear") }}';
      if (stoyear !== '') {
         $('#stoyear').val(stoyear);
         $('#stoyear').prop('required', true);
         $('#stoyear').prop('disabled', false);
      }
   });

   $('#sfrommonth').change(function() {
      var frommonthid = parseInt($(this).val())
      var tomonthid = parseInt($('#stomonth option:selected').val())
      if (tomonthid < frommonthid) {
         $('#stomonth').val('')
      }
      $('#stomonth').prop('required', true);
      $('#stomonth').prop('disabled', false);
      let fmid = $(this).val();
      if (fmid == '') {
         $("#stomonth").val('');
         $("#stomonth").attr("disabled", "disabled");
      }
      $("#stomonth > option").filter(function() {
         return $(this).attr("value") < frommonthid
      }).prop('disabled', true);
      $("#stomonth > option").filter(function() {
         return $(this).attr("value") >= frommonthid
      }).prop('disabled', false);

      var fromyearid = parseInt($('#sfromyear option:selected').val())
      var toyearid = parseInt($('#stoyear option:selected').val())
      if (toyearid > fromyearid) {
         $("#stomonth > option").prop('disabled', false);
      }
   });

   $('#sfromyear').change(function() {
      var fromyearid = parseInt($(this).val());
      var toyearid = parseInt($('#stoyear option:selected').val())
      // set att
      $('#stoyear').prop('required', true);
      $('#stoyear').prop('disabled', false);
      // ถึงปี < จากปี ถึงปีจะ set value null
      if (toyearid < fromyearid) {
         $('#stoyear').val('')
      }
      // disable to years when fromyear null 
      let fmid = $(this).val();
      if (fmid == '') {
         $("#stoyear").val('');
         $("#stoyear").attr("disabled", "disabled");
      }

      // disabled option true to years ที่ < จากปี
      $("#stoyear > option").filter(function() {
         return $(this).attr("value") < fromyearid
      }).prop('disabled', true);

      // disabled option false to years ที่ > จากปี
      $("#stoyear > option").filter(function() {
         return $(this).attr("value") >= fromyearid
      }).prop('disabled', false);

      // check to year > fromyear disabled to month
      if (toyearid > fromyearid) {
         $("#stomonth > option").prop('disabled', false);
      } else {
         var frommonthid = parseInt($('#sfrommonth option:selected').val())
         var tomonthid = parseInt($('#stomonth option:selected').val())
         if (tomonthid < frommonthid) {
            $('#stomonth').val('')
         }
         $("#stomonth > option").filter(function() {
            return $(this).attr("value") < frommonthid
         }).prop('disabled', true);
      }


      $('#stoyear').change(function() {
         var toyearid = parseInt($(this).val())
         if (toyearid > fromyearid) {
            $("#stomonth > option").prop('disabled', false);
         } else {
            var frommonthid = parseInt($('#sfrommonth option:selected').val())
            var tomonthid = parseInt($('#stomonth option:selected').val())
            if (tomonthid < frommonthid) {
               $('#stomonth').val('')
            }
            $("#stomonth > option").filter(function() {
               return $(this).attr("value") < frommonthid
            }).prop('disabled', true);
         }
      });
   });

   $('#stoyear').change(function() {
      var fromyearid = parseInt($('#sfromyear option:selected').val());
      $("#stoyear > option").filter(function() {
         return $(this).attr("value") < fromyearid
      }).prop('disabled', true);
      var toyearid = parseInt($(this).val())
      if (toyearid > fromyearid) {
         $("#stomonth > option").prop('disabled', false);
      } else {
         var frommonthid = parseInt($('#sfrommonth option:selected').val())
         var tomonthid = parseInt($('#stomonth option:selected').val())
         if (tomonthid < frommonthid) {
            $('#stomonth').val('')
         }
         $("#stomonth > option").filter(function() {
            return $(this).attr("value") < frommonthid
         }).prop('disabled', true);
      }
   });
</script>

@endsection