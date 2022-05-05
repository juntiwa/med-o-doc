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
      return activityLog::select('id','username','program_name','subject','url','method'
      ,'ip','user_agent','action','date_time')->get();
   }

   /**
    * Write code on Method
    *
    * @return response()
    */
   public function headings(): array
   {
      return ["ID", "Username","Program Name", "Description", "URL","Method", "IP", "User Agent", "Action", "Date Time"];
   }
}
