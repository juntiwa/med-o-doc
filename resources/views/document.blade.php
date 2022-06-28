<!-- resources/views/child.blade.php -->
 
@extends('layouts.app')
 
@section('title', 'ค้นหาเอกสาร')
 
@section('sidebar')
    @parent
 
    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection
 
@section('content')
   <section id="header" class="flex flex-col items-start lg:flex-row lg:justify-between mb-4">
      <h1 class="text-xl font-semibold">ค้นหาเอกสาร <span class=" text-fuchsia-600">จากทั้งหมด  {{$documentCount}}  เรื่อง</span></h1>
      @if(Route::is('document.search'))
         <label class="swap mt-3 lg:mt-0">
            <input type="checkbox" id="swapinputSearch"/>
            <div class="swap-off text-blue-700 hover:text-rose-600">ปิดช่องค้นหา</div>
            <div class="swap-on text-blue-700 hover:text-rose-600">เปิดช่องค้นหา</div>
         </label>
      @endif
   </section>
   <hr>

   <section id="inputSearch">
      <form action="{{route('document.search')}}" method="get">
         <div class="grid grid-cols-1 gap-3 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4">
            <!-- ประเภท -->
            <div class="mb-3 xl:w-full">
               <label class="label">
                  <span class="label-text text-slate-900 text-lg font-medium">ประเภทหนังสือ</span>
               </label>
               <select name="type" id="type" class="select select-bordered bg-white border-slate-400 text-lg font-medium w-full">
                  <option value="" selected>ประเภทหนังสือ</option>
                  @foreach ($typesSelectionForm as $type)
                     <option value="{{$type->typeid}}"> {{$type->typename}} </option>
                  @endforeach
                     <input type="text" name="idtype" id="idtype" value="{{old('type')}}" hidden>
               </select>
            </div>
      
            <!-- หน่วยงานที่ส่ง -->
            <div class="mb-3 xl:w-full">
               <label class="label">
                  <span class="label-text text-slate-900 text-lg font-medium">หน่วยงานที่ส่ง</span>
               </label>
               <select name="unitInner" id="unitInner" class="select select-bordered font-medium bg-white border-slate-400 text-lg w-full" >
                  <option value="" selected>หน่วยงานที่ส่ง</option>
               </select>
               <input type="text" name="idunitInner" id="idunitInner" value="{{old('unitInner')}}" hidden>
               
               <input type="text" name="unitOutter" id="unitOutter" placeholder="ระบุหน่วยงานที่ต้องการ" value="{{old('unitOutter')}}"
               class="input input-bordered w-full bg-white border-slate-400 text-lg" hidden/>
               <input type="text" name="idunitOutter" id="idunitOutter" value="{{old('idunitOutter')}}" hidden>       
            </div>
      
            <!-- หัวเรื่อง -->
            <div class="mb-3 xl:w-full md:col-span-2 lg:col-span-2">
               <label class="label">
                  <span class="label-text text-slate-900 text-lg font-medium">หัวเรื่อง <b class="text-rose-600">*</b> </span>
               </label>
               <input name="title" id="title" type="text" placeholder="ระบุหัวข้อที่ต้องการค้นหา" value="{{ old('title') }}"
               class="input input-bordered input-error w-full bg-white text-lg" required/>
            </div>
      
            <!-- ระหว่างเดือน -->
            <div class="mb-3 xl:w-full md:col-span-2 lg:col-span-4">
               <div class="form-control xl:w-full col-span-4">
                  <label class="label">
                  <span class="label-text text-slate-900 text-lg font-medium">ระหว่างเดือน</span>
                  </label>
                  <div class="grid lg:grid-cols-12 grid-cols-5 gap-4">
                     <select name="startMonth" id="startMonth" class="select select-bordered bg-white border-slate-400 col-span-2 text-lg font-medium">
                     <option value="" selected>เดือน</option>
                     @foreach ($monthsSelectionForm as $month)
                           <option value="{{$month->id}}" {{ (old("startMonth") == $month->id ? "selected": "") }}> {{$month->name_th}} </option>
                     @endforeach
                     </select>
                     <select name="startYear" id="startYear" class="select select-bordered bg-white border-slate-400 col-span-2 text-lg font-medium">
                     <option value="" selected>ปี</option>
                     @foreach($yearsSelectionForm as $resultyear)
                           @if($resultyear->regyear == "0000")
                           @else
                           <option value="{{$resultyear->regyear}}" {{ (old("startYear") == $resultyear->regyear ? "selected": "") }}> {{ $resultyear->regyear + 543 }} </option>
                           @endif
                     @endforeach
                     </select>
                     <span class="flex justify-center items-center">ถึง</span>
                     <select name="endMonth" id="endMonth" class="select select-error bg-white col-span-2 text-lg font-medium disabled:bg-gray-300" disabled>
                        <option value="" selected>เดือน</option>
                        @foreach ($monthsSelectionForm as $month)
                           <option value="{{$month->id}}" {{ (old("endMonth") == $month->id ? "selected": "") }}> {{$month->name_th}} </option>
                        @endforeach
                     </select>
                     <select name="endYear" id="endYear" class="select select-error bg-white col-span-2 text-lg font-medium disabled:bg-gray-300" disabled>
                        <option value="" selected>ปี</option>
                        @foreach($yearsSelectionForm as $resultyear)
                           @if($resultyear->regyear == "0000")
                           @else
                           <option value="{{$resultyear->regyear}}" {{ (old("endYear") == $resultyear->regyear ? "selected": "") }}> {{ $resultyear->regyear + 543 }} </option>
                           @endif
                        @endforeach
                     </select>
                     <button type="submit" class="text-white bg-teal-600 hover:bg-teal-700 rounded-md text-lg font-medium">ค้นหา</button>
               </div>
               </div>
            </div>
         </div>
      </form>
   </section>

   @if(Route::is('documents'))
      <div class="text-rose-600 text-2xl text-shadow-sm font-semibold flex justify-center pt-10">
         กรุณาระบุข้อมูลเพื่อค้นหาข้อมูลที่ต้องการ
      </div>
   @endif

   @if(Route::is('document.search'))
      <section id="tableSearch">
         <div class="pt-5">
            <h1 class="text-lg font-medium mb-2">ผลลัพธ์ การค้นหา <span>{{$resultCount}}</span> เรื่อง</h1>
            <div class="overflow-auto rounded-lg shadow-md hidden mt-6 lg:block">
               <table class="w-full">
                  <thead class="bg-gray-100 border-b-2 border-gray-200">
                     <tr>
                        <th class="w-80 lg:w-96 p-3 text-base font-semibold tracking-wide text-left">หัวเรื่อง</th>
                        <th class="w-20 p-3 text-base font-semibold tracking-wide text-left">ประเภท</th>
                        <th class="w-24 p-3 text-base font-semibold tracking-wide text-left">หน่วยงานที่ส่ง</th>
                        <th class="w-24 p-3 text-base font-semibold tracking-wide text-left">ลงวันที่</th>
                        <th class="w-16 p-3 text-base font-semibold tracking-wide text-left">เอกสารแนบ 1</th>
                        <th class="w-16 p-3 text-base font-semibold tracking-wide text-left">เอกสารแนบ 2</th>
                     </tr>
                  </thead>
                  <tbody class="divide-y divide-gray-100">
                     @forelse ($resultDocument as $result)
                        <tr class="bg-white">
                           {{-- หัวเรื่อง --}}
                           <td class="p-3 text-base text-gray-700 align-text-top">
                              <a href="{{$result->titledescription}}" class=" font-normal text-blue-500 hover:text-rose-600">{{$result->regtitle}}</a>
                           </td>
                           <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                              @if ($result->regtype == null )
                                 <span class="p-1.5 uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg bg-opacity-50">ไม่ระบุ</span>
                              @else
                                 @if ($result->type['typeid'] == 0 )
                                    <span class="p-1.5 uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">{{$result->type['typename']}}</span>
                                 @elseif ($result->type['typeid'] == 3 )
                                    <span class="p-1.5 uppercase tracking-wider text-red-800 bg-red-200 rounded-lg  bg-opacity-50">{{$result->type['typename']}}</span>
                                 @else
                                    <span class="p-1.5 uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">อื่น ๆ</span>
                                 @endif
                              @endif
                           </td>
                           <td class="p-3 text-base text-gray-700 align-text-top">
                              @if ($result->regtype == null)
                                 ไม่ระบุ
                              @else
                                 @if ($result->regtype == 0)
                                    {{$result->jobunit['unitname']}}
                                 @else
                                    {{$result->letterunit['unitname']}}
                                 @endif
                              @endif
                           </td>
                           <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                              {{$result->thai_register_date}}
                           </td>
                           <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                              @if ($result->regdoc == null)
                                 <p class="grid justify-items-center">
                                    -
                                 </p>
                              @else
                                 <a href="{{$result->regdoc_url}}" target="_blank" class="grid justify-items-center">
                                    @if (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'pdf')
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                                             <path
                                                d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($result->regdoc,PATHINFO_EXTENSION) == 'doc')
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                                             <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 
                                             64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 
                                             0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 
                                             202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 
                                             243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 
                                             229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 
                                             15.19l-25.89 77.66L214.6 248z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($result->regdoc,PATHINFO_EXTENSION) == 'xls' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                                             <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($result->regdoc,PATHINFO_EXTENSION) == 'rar' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                                             <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($result->regdoc,PATHINFO_EXTENSION) == 'jpg' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                                             <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z" />
                                          </svg>
                                    @else
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                                             <path
                                                d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                                          </svg>
                                    @endif
                                 </a>
                              @endif
                           </td>
                           <td class="p-3 text-base text-gray-700 whitespace-nowrap align-text-top">
                              @if ($result->regdoc2 == null)
                                 <p class="grid justify-items-center">
                                    -
                                 </p>
                              @else
                                 <a href="{{$result->regdoc2_url}}" target="_blank" class="grid justify-items-center">
                                    @if (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'pdf')
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                                             <path
                                                d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($result->regdoc2,PATHINFO_EXTENSION) == 'doc')
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                                             <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 
                                             64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 
                                             0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 
                                             202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 
                                             243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 
                                             229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 
                                             15.19l-25.89 77.66L214.6 248z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($result->regdoc2,PATHINFO_EXTENSION) == 'xls' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                                             <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($result->regdoc2,PATHINFO_EXTENSION) == 'rar' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                                             <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z" />
                                          </svg>
                                    @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($result->regdoc2,PATHINFO_EXTENSION) == 'jpg' )
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                                             <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z" />
                                          </svg>
                                    @else
                                          <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                                             <path
                                                d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                                          </svg>
                                    @endif
                                 </a>
                              @endif
                           </td>
                        </tr>
                     @empty
                        <p class="text-rose-600 text-2xl text-shadow-sm font-semibold flex justify-center pt-5">ไม่พบข้อมูล</p>
                     @endforelse
                  
                  </tbody>
               </table>
            </div>
         
            <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:hidden mt-4">
               @forelse ($resultDocument as $result)
               <div class="bg-white space-y-3 p-4 rounded-lg shadow relative">
                  <div class="text-base text-gray-700">
                     เลขที่หนังสือ :
                     {{$result->regid}}
                  </div>
                  <div class="flex justify-between space-x-2 text-base">
                     <div class="text-gray-500">
                        ลงวันที่ :
                        {{$result->thai_register_date}}
                     </div>
                     <div>
                        ประเภท :
                        @if ($result->regtype == null )
                           <span class="p-1.5 uppercase tracking-wider text-slate-800 bg-slate-200 rounded-lg bg-opacity-50">ไม่ระบุ</span>
                        @else
                           @if ($result->type['typeid'] == 0 )
                              <span class="p-1.5 uppercase tracking-wider text-green-800 bg-green-200 rounded-lg bg-opacity-50">{{$result->type['typename']}}</span>
                           @elseif ($result->type['typeid'] == 3 )
                              <span class="p-1.5 uppercase tracking-wider text-red-800 bg-red-200 rounded-lg  bg-opacity-50">{{$result->type['typename']}}</span>
                           @else
                              <span class="p-1.5 uppercase tracking-wider text-yellow-800 bg-yellow-200 rounded-lg bg-opacity-50">อื่น ๆ</span>
                           @endif
                        @endif
                     </div>
                  </div>
                  <div class="text-base text-gray-700">
                     หน่วยงานที่ส่ง : 
                     @if ($result->regtype == null)
                        ไม่ระบุ
                     @else
                        @if ($result->regtype == 0)
                           {{$result->jobunit['unitname']}}
                        @else
                           {{$result->letterunit['unitname']}}
                        @endif
                     @endif
                  </div>
                  <div class="text-base text-gray-700">
                     หัวเรื่อง :
                     <a href="{{$result->titledescription}}}" class=" font-normal text-blue-500 hover:text-rose-600">{{$result->regtitle}}</a>
                  </div>
                  <div class="flex text-base text-gray-700 pt-10">
                     <div class="absolute left-3 bottom-3 min-h-max max-h-full ">
                        @if ($result->regdoc == null )
                        @if ($result->regdoc == null && $result->regdoc2 == null)
                        <p class="grid justify-items-center">
                           ไม่มีเอกสารแนบ
                        </p>
                        @else
                        <p class="grid justify-items-center">
                           -
                        </p>
                        @endif
                        @else
                        <a href="/open-files/{{date('Y',strtotime($result->regdate))}}/{{ pathinfo( $result->regdoc , PATHINFO_EXTENSION ) }}/{{ pathinfo( $result->regdoc , PATHINFO_FILENAME ) }}" target=" _blank" class="grid justify-items-center">
                           @if (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'pdf')
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                              <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'doc')
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'xls' )
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'rar' )
                              <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                                 <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                              </svg>
                              @elseif (pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($result->regdoc, PATHINFO_EXTENSION) == 'jpg' )
                              <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                                 <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                              </svg>
                           @else
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                           </svg>
                           @endif
                        </a>
                        @endif
                     </div>
                     <div class="absolute left-16 bottom-3 min-h-max max-h-full ">
                        @if ($result->regdoc2 == null)
                        <p class="grid justify-items-center">
                           
                        </p>
                        @else
                        <a href="/open-files/{{date('Y',strtotime($result->regdate))}}/{{ pathinfo( $result->regdoc2 , PATHINFO_EXTENSION ) }}/{{ pathinfo( $result->regdoc2 , PATHINFO_FILENAME ) }}" target=" _blank" class="grid justify-items-center">
                           @if (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'pdf')
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
                              <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'doc')
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'xls' )
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
                           </svg>
                           @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'rar' )
                              <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
                                 <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
                              </svg>
                              @elseif (pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($result->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
                              <svg xmlns="http://www.w3.org/2000/svg"  class=" w-8 fill-sky-400" viewBox="0 0 384 512">
                                 <path d="M224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 224c17.67 0 32 14.33 32 32S113.7 288 96 288S64 273.7 64 256S78.33 224 96 224zM318.1 439.5C315.3 444.8 309.9 448 304 448h-224c-5.9 0-11.32-3.248-14.11-8.451c-2.783-5.201-2.479-11.52 .7949-16.42l53.33-80C122.1 338.7 127.1 336 133.3 336s10.35 2.674 13.31 7.125L160 363.2l45.35-68.03C208.3 290.7 213.3 288 218.7 288s10.35 2.674 13.31 7.125l85.33 128C320.6 428 320.9 434.3 318.1 439.5zM256 0v128h128L256 0z"/>
                              </svg>
                           @else
                           <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-slate-700" viewBox="0 0 384 512">
                              <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0L64-.0001c-35.35 0-64 28.65-64 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM96 280C96 293.3 106.8 304 120 304h144C277.3 304 288 293.3 288 280S277.3 256 264 256h-144C106.8 256 96 266.8 96 280zM264 352h-144C106.8 352 96 362.8 96 376s10.75 24 24 24h144c13.25 0 24-10.75 24-24S277.3 352 264 352z" />
                           </svg>
                           @endif
                        </a>
                        @endif
                     </div>
                  </div>
               </div>
               @empty
                  <p class="text-rose-600 text-2xl text-shadow-sm font-semibold flex justify-center pt-5">ไม่พบข้อมูล</p>
               @endforelse
            </div>
         </div>
         <div class="col-md-12 mt-6 mb-6">
            {{$resultDocument->withQueryString()->links('pagination::tailwind')}}
         </div>
      </section>
   @endif


   <script src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"
      integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   <script src="{{asset('js/document.js')}}"></script>

@endsection