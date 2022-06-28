<?php

namespace Database\Seeders;

use App\Models\Month;
use Illuminate\Database\Seeder;

class MonthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $months = [
         ['name_th'=>'มกราคม', 'name_eng'=>'January'],
         ['name_th'=>'กุมภาพันธ์', 'name_eng'=>'February'],
         ['name_th'=>'มีนาคม', 'name_eng'=>'March'],
         ['name_th'=>'เมษายน', 'name_eng'=>'April'],
         ['name_th'=>'พฤษภาคม', 'name_eng'=>'May'],
         ['name_th'=>'มิถุนายน', 'name_eng'=>'June'],
         ['name_th'=>'กรกฎาคม', 'name_eng'=>'July'],
         ['name_th'=>'สิงหาคม', 'name_eng'=>'August'],
         ['name_th'=>'กันยายน', 'name_eng'=>'September'],
         ['name_th'=>'ตุลาคม', 'name_eng'=>'October'],
         ['name_th'=>'พฤศจิกายน', 'name_eng'=>'November'],
         ['name_th'=>'ธันวาคม', 'name_eng'=>'December'],
        ];

        foreach ($months as $month) {
            Month::create($month);
        }
    }
}
