@extends('layouts.app')
@section('title', 'ลงทะเบียนหนังสือส่ง')
@section('sidebar')
@parent
@endsection
@section('content')

<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
   <table class="w-full text-base text-left text-gray-500 dark:text-gray-400">
      <thead class="text-base text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
         <tr>
            <th scope="col" class="px-6 py-3">
               ลำดับ
            </th>
            <th scope="col" class="px-6 py-3">
               ชื่อผู้ใช้
            </th>
            <th scope="col" class="px-6 py-3">
               Email
            </th>
            <th scope="col" class="px-6 py-3">
               Action
            </th>
            <th scope="col" class="px-6 py-3">
               เมื่อ
            </th>
         </tr>
      </thead>
      <tbody>
         @foreach ($activityLog as $key => $item)
         <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            <td class="px-6 py-4">
               {{ ++$key }}
            </td>
            <th scope="row" class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
               {{ $item->username }}
            </th>

            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
               {{ $item->email }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
               {{ $item->description }}
            </td>
            <td class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
               {{ $item->date_time }}
            </td>
         </tr>
         @endforeach
      </tbody>
   </table>
</div>

@endsection