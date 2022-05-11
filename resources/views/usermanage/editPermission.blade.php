@extends('layouts.app')
@section('title', 'Activity Log')
@section('sidebar')
@parent
@endsection
@section('content')

<form action="{{route('update.permis', $user->id)}}" class="mt-6" method="POST">
   @csrf
   <!-- component -->
   <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 flex flex-col my-2">
      <div class="-mx-3 md:flex mb-6">
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-last-name">
               Username
            </label>
            <input disabled class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" name="username" id="grid-first-name" type="text" value="{{ $user->username}}">
         </div>
         <div class="md:w-1/2 px-3 mb-6 md:mb-0">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-first-name">
               Full Name
            </label>
            <input disabled name="full_name" class="appearance-none block w-full disabled:bg-slate-100 disabled:border-slate-200 text-grey-darker border border-red rounded py-3 
            px-4 mb-3" id="grid-first-name" type="text" value="{{ $user->full_name}}">
         </div>
      </div>

      <div class="-mx-3 md:flex mb-6">
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
               Role
            </label>
            <div class="relative">
               <select name="role" class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-3 px-4 pr-8 rounded" id="grid-state">
                  <option value="1" {{ old('role', $user->is_admin) == 1 ? 'selected' : '' }}>Admin</option>
                  <option value="0" {{ old('role', $user->is_admin) == 0 ? 'selected' : '' }}>User</option>
               </select>
            </div>
         </div>
         <div class="md:w-1/2 px-3">
            <label class="block uppercase tracking-wide text-grey-darker text-xs font-bold mb-2" for="grid-state">
               Status
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
            <button type="submit" class="inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight 
         uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700 focus:shadow-lg focus:outline-none 
         focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out">บันทึกข้อมูล</button>
         </div>
      </div>
   </div>
</form>


@endsection