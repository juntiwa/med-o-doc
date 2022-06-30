<?php

namespace App\Exports;

use App\Models\LogActivity;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LogActivityExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return LogActivity::select("id", "username", "full_name", "office_name", "action", "type", "date_time")->orderby('date_time', 'desc')->get();
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function headings(): array
    {
        return ["ลำดับ", "ชื่อผู้ใช้งาน", "ชื่อ สกุล","Action","ประเภทของ Action","ช่วงเวลา"];
    }
}
