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
        return activityLog::select(
            'id',
            'username',
            'full_name',
            'office_name',
            'action',
            'type',
            'date_time'
        )->get();
    }

    /**
     * Write code on Method.
     *
     * @return response()
     */
    public function headings(): array
    {
        return ['ID', 'ชื่อผู้ใช้งาน', 'ชื่อ สกุล', 'หน่วยงาน', 'Action', 'ประเภท', 'Date Time'];
    }
}
