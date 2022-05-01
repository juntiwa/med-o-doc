<?php

namespace App\Exports;

use App\Models\activityLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ActivityLogsExport implements FromCollection, WithHeadings
{
   /**
    * @return \Illuminate\Support\Collection
    */
   public function collection()
   {
      return activityLog::select("id", "username", "email","description","date_time")->get();
   }

   /**
    * Write code on Method
    *
    * @return response()
    */
   public function headings(): array
   {
      return ["ID", "Username","Email", "Description", "Date_Time"];
   }
}
