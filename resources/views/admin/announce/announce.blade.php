@extends('layouts.app')

@section('title', 'ค้นหาเอกสาร')

@section('sidebar')
    @parent

    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection

@section('content')
    <div class="flex align-center justify-center text-lg mb-5">
        <div class="container bg-sky-100 rounded-lg p-5">
            <form action="{{route('announce.store')}}" method="POST" class="grid grid-cols-1 gap-4">
                @csrf
                <label for="topic_announces" class="flex flex-col"> รายละเอียดข่าว
                    <textarea name="topic_announces" id="topic_announces"
                              class="mt-2 textarea textarea-bordered text-lg h-40 bg-white" required="Test"></textarea>
                </label>
                {{-- <label for="statuses" class="flex flex-col">สถานะข่าวประกาศ
                    <select name="statuses" id="statuses"
                            class="mt-2 select select-bordered bg-white border-slate-400 text-lg font-medium h-14 w-full">
                        <option value="true">แสดงข่าวประกาศ</option>
                        <option value="false">ปิดข่าวประกาศ</option>
                    </select>
                </label> --}}

                <div class="hidden lg:block"></div>
                <div class="flex justify-end">
                    <button type="submit" id="submit"
                            class="text-white bg-teal-600 hover:bg-teal-700 rounded-md text-lg font-medium w-1/3 py-2">
                        เพิ่มประกาศ
                    </button>
                </div>
            </form>

        </div>

    </div>
    @foreach($announces as $announce)
        <div class="flex align-center justify-center text-lg mb-5">
            <div class="container bg-slate-100 rounded-lg p-5 mb-5">
                <div class="flex flex-col mr-6 leading-8">
                    <div id="header_topic" class="w-full">
                        <div class="flex flex-row items-center">
                            <p class="font-semibold mr-3">
                                # ข่าวประกาศที่ {{$announce->id}}
                            </p>
                            <div id="edit_status" class="pr-3">
                                <form method="post" action="{{route('announce.updateStatus',$announce->id)}}">
                                    @csrf
                                    @if($announce->statuses === "true")
                                        <label class="cursor-pointer">
                                            <input type="submit" name="statuses" id="statuses" value="false" hidden>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#2dd4bf" viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </label>
                                    @else
                                    <label class="cursor-pointer">
                                            <input type="submit" name="statuses" id="statuses" value="true" hidden>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="#fb7185" viewBox="0 0 24 24"
                                                 stroke-width="1.5"
                                                 stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                      d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88"/>
                                            </svg>
                                        </label>
                                    @endif
                                </form>
                            </div>
                            <div id="edit_topic">
                                <label for="my-modal-{{$announce->id}}" class="cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#7dd3fc" viewBox="0 0 24 24"
                                         stroke-width="1.5"
                                         stroke="currentColor" class="w-6 h-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10"/>
                                    </svg>
                                </label>
                                <!-- Put this part before </body> tag -->
                                <input type="checkbox" id="my-modal-{{$announce->id}}" class="modal-toggle"/>
                                <div class="modal">
                                    <div class="modal-box w-9/12 max-w-4xl relative bg-white">
                                        <label for="my-modal-{{$announce->id}}"
                                               class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                        <h3 class="text-lg font-bold">แก้ไขข่าวสารที่ต้องการแสดง !</h3>
                                        <p class="py-4">
                                            <form action="{{route('announce.update',$announce->id)}}" method="post">
                                                @csrf
                                                <label for="topic_announces" class="flex flex-col mb-5"> รายละเอียดข่าว
                                                    <textarea name="topic_announces" id="topic_announces"
                                                              class="mt-2 textarea textarea-bordered text-lg h-40 bg-white">{{$announce->topic_announces}}</textarea>
                                                </label>
                                                <div class="flex justify-end">
                                                    <button type="submit"
                                                            class="text-white bg-violet-500 hover:bg-violet-600 rounded-md text-lg font-medium w-1/5 py-2">
                                                        บันทึก
                                                    </button>
                                                </div>
                                            </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                           {{$announce->topic_announces}}
                        </div>
                    </div>
                    {{-- <div id="status">
                        @if($announce->statuses === "true")
                            <p class="text-emerald-600">สถานะประกาศ : แสดงประกาศ </p>
                        @else
                            <p class="text-rose-500">สถานะประกาศ : ปิดประกาศ</p>
                        @endif
                    </div> --}}
                </div>
            </div>
        </div>
    @endforeach
<script type="text/javascript">
const topic = document.querySelector('#topic_announces');
const submit = document.querySelector('#submit');
submit.addEventListener('click', () => {
   if (topic.validity.valueMissing) {
      topic.setCustomValidity('กรุณากรอกรายละเอียดข่าว');
   } else {
      topic.setCustomValidity('');
   }
});
</script>
@endsection
