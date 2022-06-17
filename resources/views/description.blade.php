@extends('layouts.app')
@section('title', 'ลงทะเบียนหนังสือส่ง')
@section('sidebar')
@parent
@endsection
@section('content')
<p class="text-base font-medium text-gray-900 pb-3">
   หัวเรื่อง : 
   <span class="text-blue-600 "> {{$regTbl->regtitle}}</span> 
</p>
<div class="grid grid-cols-4 md:grid-cols-3 sm:grid-cols-1 pb-3">
   <p class="flex text-base font-medium text-gray-900">
      <span class="pr-3">วันที่ลงทะเบียน :</span> 
      {{$regTbl->thaidateregdate()}}
   </p>
   <p class="flex text-base font-medium text-gray-900 col-span-2">
   <span class="pr-3">หน่วยงานที่ส่ง :</span> 
   <!-- ตรวจสอบค่า regtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
      @if ($regTbl->regtype == null )
            ไม่ระบุ
      @else
         @if($regTbl->regtype == 0)
         {{$regTbl->regfrom}}
         ในภาค
         @foreach($regTbl->desfromins as $fromins)
         {{$fromins->unitname}}
         @endforeach
         @elseif($regTbl->regtype == 3)
         {{$regTbl->regfrom}}
         นอกภาค
         @foreach($regTbl->desfromouts as $fromouts)
         {{$fromouts->unitname}}
         @endforeach
         @else
         อื่น ๆ
         @endif
      <!-- endif regtype = null-->
      @endif
   </p>
</div>
<div class="grid grid-cols-2 md:grid-cols-1 pb-3">
   <p class="flex text-base font-medium text-gray-900 pb-3">
      <span class="pr-3">เอกสารแนบ1 :</span> 
      @if ($regTbl->regdoc == null)
         <span>
            ไม่มีเอกสารแนบ
         </span>
      @else
         <a href="{{$regTbl->regdoc_url}}" target="_blank" >
            @if (pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'pdf')
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
               <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'docx' || pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'doc')
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
               <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'xls' )
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
               <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'zip' || pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'rar' )
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
               <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
            </svg>
            @elseif (pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'png' || pathinfo($regTbl->regdoc, PATHINFO_EXTENSION) == 'jpg' )
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
   </p>
   <p class="flex text-base font-medium text-gray-900 pb-3">
      <span class="pr-3">เอกสารแนบ2 :</span> 
      @if ($regTbl->regdoc2 == null)
         <span>
            ไม่มีเอกสารแนบ
         </span>
      @else
         <a href="{{$regTbl->regdoc2_url}}" target="_blank" >
            @if (pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'pdf')
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-red-500 " viewBox="0 0 384 512">
               <path d="M320 464C328.8 464 336 456.8 336 448V416H384V448C384 483.3 355.3 512 320 512H64C28.65 512 0 483.3 0 448V416H48V448C48 456.8 55.16 464 64 464H320zM256 160C238.3 160 224 145.7 224 128V48H64C55.16 48 48 55.16 48 64V192H0V64C0 28.65 28.65 0 64 0H229.5C246.5 0 262.7 6.743 274.7 18.75L365.3 109.3C377.3 121.3 384 137.5 384 154.5V192H336V160H256zM88 224C118.9 224 144 249.1 144 280C144 310.9 118.9 336 88 336H80V368C80 376.8 72.84 384 64 384C55.16 384 48 376.8 48 368V240C48 231.2 55.16 224 64 224H88zM112 280C112 266.7 101.3 256 88 256H80V304H88C101.3 304 112 293.3 112 280zM160 240C160 231.2 167.2 224 176 224H200C226.5 224 248 245.5 248 272V336C248 362.5 226.5 384 200 384H176C167.2 384 160 376.8 160 368V240zM192 352H200C208.8 352 216 344.8 216 336V272C216 263.2 208.8 256 200 256H192V352zM336 224C344.8 224 352 231.2 352 240C352 248.8 344.8 256 336 256H304V288H336C344.8 288 352 295.2 352 304C352 312.8 344.8 320 336 320H304V368C304 376.8 296.8 384 288 384C279.2 384 272 376.8 272 368V240C272 231.2 279.2 224 288 224H336z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'docx' || pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'doc')
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-blue-500" viewBox="0 0 384 512">
               <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM214.6 248C211.3 238.4 202.2 232 192 232s-19.25 6.406-22.62 16L144.7 318.1l-25.89-77.66C114.6 227.8 101 221.2 88.41 225.2C75.83 229.4 69.05 243 73.23 255.6l48 144C124.5 409.3 133.5 415.9 143.8 416c10.17 0 19.45-6.406 22.83-16L192 328.1L217.4 400C220.8 409.6 229.8 416 240 416c10.27-.0938 19.53-6.688 22.77-16.41l48-144c4.188-12.59-2.594-26.16-15.17-30.38c-12.61-4.125-26.2 2.594-30.36 15.19l-25.89 77.66L214.6 248z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'xlsx' || pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'xls' )
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-green-600" viewBox="0 0 384 512">
               <path d="M365.3 93.38l-74.63-74.64C278.6 6.742 262.3 0 245.4 0H64C28.65 0 0 28.65 0 64l.0065 384c0 35.34 28.65 64 64 64H320c35.2 0 64-28.8 64-64V138.6C384 121.7 377.3 105.4 365.3 93.38zM336 448c0 8.836-7.164 16-16 16H64.02c-8.838 0-16-7.164-16-16L48 64.13c0-8.836 7.164-16 16-16h160L224 128c0 17.67 14.33 32 32 32h79.1V448zM229.1 233.3L192 280.9L154.9 233.3C146.8 222.8 131.8 220.9 121.3 229.1C110.8 237.2 108.9 252.3 117.1 262.8L161.6 320l-44.53 57.25c-8.156 10.47-6.25 25.56 4.188 33.69C125.7 414.3 130.8 416 135.1 416c7.156 0 14.25-3.188 18.97-9.25L192 359.1l37.06 47.65C233.8 412.8 240.9 416 248 416c5.125 0 10.31-1.656 14.72-5.062c10.44-8.125 12.34-23.22 4.188-33.69L222.4 320l44.53-57.25c8.156-10.47 6.25-25.56-4.188-33.69C252.2 220.9 237.2 222.8 229.1 233.3z" />
            </svg>
            @elseif (pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'zip' || pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'rar' )
            <svg xmlns="http://www.w3.org/2000/svg" class=" w-8 fill-orange-400" viewBox="0 0 384 512">
               <path d="M256 0v128h128L256 0zM224 128L224 0H48C21.49 0 0 21.49 0 48v416C0 490.5 21.49 512 48 512h288c26.51 0 48-21.49 48-48V160h-127.1C238.3 160 224 145.7 224 128zM96 32h64v32H96V32zM96 96h64v32H96V96zM96 160h64v32H96V160zM128.3 415.1c-40.56 0-70.76-36.45-62.83-75.45L96 224h64l30.94 116.9C198.7 379.7 168.5 415.1 128.3 415.1zM144 336h-32C103.2 336 96 343.2 96 352s7.164 16 16 16h32C152.8 368 160 360.8 160 352S152.8 336 144 336z"/>
            </svg>
            @elseif (pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'png' || pathinfo($regTbl->regdoc2, PATHINFO_EXTENSION) == 'jpg' )
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
   </p>
</div>

<div class="overflow-auto rounded-lg shadow-sm hidden mt-6 lg:block">
   <table class="w-full">
      <thead class="bg-gray-50 border-b-2 border-gray-200">
         <tr>
            <th class="w-14 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ลำดับ</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">วันที่ส่ง</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">ส่งถึง</th>
            <th class="w-32 p-3 text-base text-gray-800 font-semibold tracking-wide text-left">วันที่รับ</th>
         </tr>
      </thead>
      <tbody class="divide-y divide-gray-100 items-start">
         @foreach($regisTable as $key =>$reg) 
         <tr class="bg-white">
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               {{++$key}}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
              {{$reg->thaidatesenddate()}}
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
              {{$reg->sendtoid}}
              {{$regTbl->regtype}}
              <!-- ตรวจสอบค่า regtype ถ้าค่าเป็น null แสดง ไม่ระบุ -->
               @if ($regTbl->regtype == null )
               ไม่ระบุ
               @else
                  @if($regTbl->regtype == 0)
                  {{-- {{$regTbl->regtype}} --}}
                  @foreach($reg->destoins as $toins)
                  {{$toins->unitname}}
                  @endforeach
                  @elseif($regTbl->regtype == 3)
                   @foreach($reg->destoouts as $toins)
                  {{$toins->unitname}}
                  @endforeach
                  @else
                  อื่น ๆ
                  @endif
               <!-- endif regtype = null-->
               @endif
            </td>
            <td class="p-3 text-base text-gray-800 font-medium align-text-top">
               @if ($reg->recdate == null )
               <p class=" text-red-500">ยังไม่มีการรับ</p>
               @else              
               {{$reg->thaidaterecdate()}}
               @endif
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>
@endsection