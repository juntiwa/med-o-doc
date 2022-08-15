

@extends('layouts.app')

@section('title', 'ค้นหาเอกสาร')

@section('sidebar')
    @parent

    <!-- <p>This is appended to the master sidebar.</p> -->
@endsection

@section('content')
{!! Toastr::message() !!}
   <section id="button" class="flex items-end justify-end w-full">
      <!-- The button to open modal -->
      <a href="{{route('manage.create')}}">
         <label class="modal-button flex items-end justify-end w-fit px-3 py-2 rounded-md bg-blue-900 hover:bg-blue-800 text-white cursor-pointer">
            <svg class="add_member" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
               <path d="M224 256c70.7 0 128-57.31 128-128S294.7 0 224 0C153.3 0 96 57.31 96 128S153.3 256 224 256zM274.7 304H173.3C77.61 304 0 381.6 0 477.3C0 496.5 15.52 512 34.66 512h378.7C432.5 512 448 496.5 448 477.3C448 381.6 370.4 304 274.7 304zM616 200h-48v-48C568 138.8 557.3 128 544 128s-24 10.75-24 24v48h-48C458.8 200 448 210.8 448 224s10.75 24 24 24h48v48C520 309.3 530.8 320 544 320s24-10.75 24-24v-48h48C629.3 248 640 237.3 640 224S629.3 200 616 200z" />
            </svg>
            เพิ่มสิทธิ์ผู้ใช้งาน
         </label>
      </a>
   </section>

   <section id="dataUser">
       <div class="overflow-auto rounded-lg shadow-md hidden mt-6 lg:block">
         <table class="w-full">
            <thead class="bg-gray-100 border-b-2 border-gray-200">
               <tr>
                  <th class="w-20 p-3 text-base font-semibold text-left">#</th>
                  <th class="w-24 p-3 text-base font-semibold text-left">SAPID</th>
                  <th class="w-24 p-3 text-base font-semibold text-left">ชื่อผู้ใช้งาน</th>
                  <th class="w-32 p-3 text-base font-semibold text-left">ชื่อ สกุล</th>
                  <th class="w-32 p-3 text-base font-semibold text-left">หน่วยงาน</th>
                  <th class="w-32 p-3 text-base font-semibold text-left">สิทธิ์การเข้าถึง</th>
                  <th class="w-32 p-3 text-base font-semibold text-left">สถานะ</th>
                  <th class="w-16 p-3 text-base font-semibold text-left">แก้ไข</th>
               </tr>
           </thead>
           <tbody class="divide-y divide-gray-100">
            @forelse ($userPermission as $key => $user)
               <tr class="bg-white">
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     {{++$key}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     <div class="flex">
                        <p id="sapHidden{{$user->org_id}}">100xxxxx</p>
                        <p id="sapShow{{$user->org_id}}"></p>
                        <label class="swap swap-rotate cursor-pointer">
                           <!-- this hidden checkbox controls the state -->
                           <input type="checkbox" id="{{$user->org_id}}" class="switch{{$user->org_id}} sr-only peer" onClick="sap_click(this.id)"/>
                           <svg class="swap-on fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                              <path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/>
                           </svg>
                           <svg class="swap-off fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                              <path fill="#0092E4" d="M10.94,6.08A6.93,6.93,0,0,1,12,6c3.18,0,6.17,2.29,7.91,6a15.23,15.23,0,0,1-.9,1.64,1,1,0,0,0-.16.55,1,1,0,0,0,1.86.5,15.77,15.77,0,0,0,1.21-2.3,1,1,0,0,0,0-.79C19.9,6.91,16.1,4,12,4a7.77,7.77,0,0,0-1.4.12,1,1,0,1,0,.34,2ZM3.71,2.29A1,1,0,0,0,2.29,3.71L5.39,6.8a14.62,14.62,0,0,0-3.31,4.8,1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20a9.26,9.26,0,0,0,5.05-1.54l3.24,3.25a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Zm6.36,9.19,2.45,2.45A1.81,1.81,0,0,1,12,14a2,2,0,0,1-2-2A1.81,1.81,0,0,1,10.07,11.48ZM12,18c-3.18,0-6.17-2.29-7.9-6A12.09,12.09,0,0,1,6.8,8.21L8.57,10A4,4,0,0,0,14,15.43L15.59,17A7.24,7.24,0,0,1,12,18Z"/>
                           </svg>
                         </label>
                     </div>
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     {{$user->username}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     @if ($user->full_name == null)
                         <p class="text-rose-600">รอ update ข้อมูล</p>
                     @else
                        {{$user->full_name}}
                     @endif
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     {{$user->office_name}}
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     @if ($user->is_admin == "1" )
                        <p class="table-row__p-status status--red status text-base">Admin</p>
                        @else
                        <p class="table-row__p-status status--yellow status text-base">User</p>
                        @endif
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     @if ($user->status == "Active" )
                     <p class="table-row__status status--green status text-base">{{$user->status}}</p>
                     @else
                     <p class="table-row__status text-base">{{$user->status}}</p>
                     @endif
                  </td>
                  <td class="p-3 text-base text-gray-700 whitespace-nowrap">
                     @if (Auth::user()->office_name == "หน่วยเวชสารสนเทศและบริหารข้อมูล")
                        @if ($user->org_id == Auth::user()->org_id)
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-rose-500">
                              <path d="M7 10h10v4H7z"></path>
                              <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                           </svg>
                        @else
                            <!-- The button to open modal -->
                           <label for="my-modal-{{$user->id}}" class="modal-button">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400 hover:fill-blue-600 cursor-pointer">
                                 <path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0
                                    0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z">
                                 </path>
                              </svg>
                           </label>

                           <!-- Put this part before </body> tag -->
                           <input type="checkbox" id="my-modal-{{$user->id}}" class="modal-toggle" />
                           <div class="modal">
                              <div class="modal-box relative bg-white w-11/12 max-w-5xl">
                                 <label for="my-modal-{{$user->id}}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                 <h3 class="text-lg font-bold">แก้ไขข้อมูลผู้ใช้งาน</h3>
                                 <p class="py-4">
                                    <section id="formEdit">
                                       <form class="space-y-6 w-full" action="{{ route('manage.update',$user->org_id) }}" method="post">
                                          @csrf
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
                                             <label for="office_name" class="block mb-2 text-base font-medium text-gray-900">หน่วยงาน</label>
                                             <select name="office_name" id="office_name" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg
                                             focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 ">
                                              <option selected value="">---- เลือกหน่วยงานของคุณ ----</option>
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
                                           <div class="flex items-end justify-end w-fit">
                                              <button type="submit" class="w-full text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none
                                             focus:ring-teal-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">บันทึกการแก้ไขข้อมูล</button>
                                           </div>

                                       </form>
                                    </section>
                                 </p>
                              </div>
                           </div>
                        @endif
                     @else
                          @if ($user->office_name == Auth::user()->office_name || $user->office_name== "หน่วยเวชสารสนเทศและบริหารข้อมูล")
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-rose-500">
                              <path d="M7 10h10v4H7z"></path>
                              <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>
                           </svg>
                        @else
                           <!-- The button to open modal -->
                           <label for="my-modal-{{$user->id}}" class="modal-button">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400 hover:fill-blue-600 cursor-pointer">
                                 <path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0
                                    0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z">
                                 </path>
                              </svg>
                           </label>

                           <!-- Put this part before </body> tag -->
                           <input type="checkbox" id="my-modal-{{$user->id}}" class="modal-toggle" />
                           <div class="modal">
                              <div class="modal-box relative bg-white w-11/12 max-w-5xl">
                                 <label for="my-modal-{{$user->id}}" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                 <h3 class="text-lg font-bold">แก้ไขข้อมูลผู้ใช้งาน</h3>
                                 <p class="py-4">
                                    <section id="formEdit">
                                       <form class="space-y-6 w-full" action="{{ route('manage.update',$user->org_id) }}" method="post">
                                          @csrf
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
                                             <label for="office_name" class="block mb-2 text-base font-medium text-gray-900">หน่วยงาน</label>
                                             <select name="office_name" id="office_name" class="bg-white border border-gray-300 text-gray-900 text-base rounded-lg
                                             focus:ring-teal-500 focus:border-teal-500 block w-full p-2.5 ">
                                              <option selected value="">---- เลือกหน่วยงานของคุณ ----</option>
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
                                           <div class="flex items-end justify-end w-fit">
                                              <button type="submit" class="w-full text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none
                                             focus:ring-teal-300 font-medium rounded-lg text-base px-5 py-2.5 text-center">บันทึกการแก้ไขข้อมูล</button>
                                           </div>

                                       </form>
                                    </section>
                                 </p>
                              </div>
                           </div>
                        @endif
                     @endif
                  </td>
               </tr>
            @empty
               <tr class="col-span-6 text-shadow-sm font-semibold flex pl-2 py-5">
                  <td >
                     <p class="text-rose-600 text-2xl ">ไม่พบข้อมูล</p>
                  </td>
               </tr>
            @endforelse
           </tbody>
         </table>
       </div>

       <div class="grid grid-cols-1 sm:grid-cols-1 gap-4 md:grid-cols-2 lg:hidden mt-4">
         @forelse ($userPermission as $key => $user)
         <div class="bg-white space-y-3 p-4 rounded-lg shadow">
           <div class="flex justify-between space-x-2 text-base">
            <div class="flex">
               <div class="pr-2">
                  <p class="text-blue-500 font-bold">#{{++$key}}</p>
                </div>
                <div class="text-gray-500 flex">
                  <p id="sapHidden_{{$user->org_id}}" >100xxxxx</p>
                  <p id="sapShow_{{$user->org_id}}"></p>
                  <label class="swap swap-rotate cursor-pointer">
                     <!-- this hidden checkbox controls the state -->
                     <input type="checkbox" id="{{$user->org_id}}" class="switch{{$user->org_id}} sr-only peer" onClick="sap_click(this.id)"/>
                     <svg class="swap-on fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M21.92,11.6C19.9,6.91,16.1,4,12,4S4.1,6.91,2.08,11.6a1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20s7.9-2.91,9.92-7.6A1,1,0,0,0,21.92,11.6ZM12,18c-3.17,0-6.17-2.29-7.9-6C5.83,8.29,8.83,6,12,6s6.17,2.29,7.9,6C18.17,15.71,15.17,18,12,18ZM12,8a4,4,0,1,0,4,4A4,4,0,0,0,12,8Zm0,6a2,2,0,1,1,2-2A2,2,0,0,1,12,14Z"/>
                     </svg>
                     <svg class="swap-off fill-current w-5 h-5 ml-3" xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 24 24">
                        <path fill="#0092E4" d="M10.94,6.08A6.93,6.93,0,0,1,12,6c3.18,0,6.17,2.29,7.91,6a15.23,15.23,0,0,1-.9,1.64,1,1,0,0,0-.16.55,1,1,0,0,0,1.86.5,15.77,15.77,0,0,0,1.21-2.3,1,1,0,0,0,0-.79C19.9,6.91,16.1,4,12,4a7.77,7.77,0,0,0-1.4.12,1,1,0,1,0,.34,2ZM3.71,2.29A1,1,0,0,0,2.29,3.71L5.39,6.8a14.62,14.62,0,0,0-3.31,4.8,1,1,0,0,0,0,.8C4.1,17.09,7.9,20,12,20a9.26,9.26,0,0,0,5.05-1.54l3.24,3.25a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Zm6.36,9.19,2.45,2.45A1.81,1.81,0,0,1,12,14a2,2,0,0,1-2-2A1.81,1.81,0,0,1,10.07,11.48ZM12,18c-3.18,0-6.17-2.29-7.9-6A12.09,12.09,0,0,1,6.8,8.21L8.57,10A4,4,0,0,0,14,15.43L15.59,17A7.24,7.24,0,0,1,12,18Z"/>
                     </svg>
                   </label>
               </div>
            </div>
            <div class="flex">
               <div>
                  @if ($user->is_admin == "1" )
                  <p class="table-row__p-status status--red status text-base">Admin</p>
                  @else
                  <p class="table-row__p-status status--yellow status text-base">User</p>
                  @endif
               </div>
               <div class="pl-3">
                  @if (Auth::user()->office_name == "หน่วยเวชสารสนเทศและบริหารข้อมูล")
                     @if ($user->org_id == Auth::user()->org_id)
                     @else
                        <a href="{{route('manage.edit', $user->org_id)}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400">
                              <path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0
                                 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z">
                              </path>
                           </svg>
                        </a>
                     @endif
                  @else
                     @if ($user->office_name == Auth::user()->office_name || $user->office_name== "หน่วยเวชสารสนเทศและบริหารข้อมูล")
                     @else
                        <a href="{{route('manage.edit', $user->org_id)}}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" class="fill-blue-400">
                              <path d="M4 21a1 1 0 0 0 .24 0l4-1a1 1 0 0 0 .47-.26L21 7.41a2 2 0 0 0 0-2.82L19.42 3a2 2 0 0 0-2.83 0L4.3 15.29a1.06 1.06 0 0 0-.27.47l-1 4A1 1 0
                                 0 0 3.76 21 1 1 0 0 0 4 21zM18 4.41 19.59 6 18 7.59 16.42 6zM5.91 16.51 15 7.41 16.59 9l-9.1 9.1-2.11.52z">
                              </path>
                           </svg>
                        </a>
                     @endif
                  @endif
               </div>
            </div>
           </div>
           <div class="text-base text-gray-700 leading-loose">
            <p> ชื่อผู้ใช้งาน :
               @if ($user->username == null)
                  <span class="text-rose-600">รอ update ข้อมูล</span>
               @else
                  {{$user->username}}
               @endif
            </p>
            <p> ชื่อ สกุล :
               @if ($user->full_name == null)
                  <span class="text-rose-600">รอ update ข้อมูล</span>
               @else
                  {{$user->full_name}}
               @endif
            </p>
            <p> หน่วยงาน :
               @if ($user->office_name == null)
                  <span class="text-rose-600">รอ update ข้อมูล</span>
               @else
                  {{$user->office_name}}
               @endif
            </p>
           </div>
           <div class="text-base font-medium text-black">
            @if ($user->status == "Active" )
               <p class="table-row__status status--green status text-base">{{$user->status}}</p>
            @else
               <p class="table-row__status text-base">{{$user->status}}</p>
            @endif
           </div>
         </div>
         @empty
            <p class="text-rose-600 text-2xl text-shadow-sm font-semibold flex justify-center pt-5">ไม่พบข้อมูล</p>
         @endforelse
       </div>
   </section>

   <script type="text/javascript">
      let sapidroute = "{{route('check.sapid.show')}}";
      let existuser = "{{route('exist.user')}}"
      var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
   </script>
   <script type="text/javascript" src="{{asset(mix('js/manageuser.js'))}}"></script>
@endsection
