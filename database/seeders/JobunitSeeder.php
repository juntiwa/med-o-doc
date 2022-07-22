<?php

namespace Database\Seeders;

use App\Models\Jobunit;
use Illuminate\Database\Seeder;

class JobunitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Jobunit::seed('public/files/seeders/Jobunits.csv');
    }
}
