<?php

namespace Database\Seeders;

use App\Models\Letterunit;
use Illuminate\Database\Seeder;

class LetterunitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Letterunit::seed('public/files/seeders/Letterunits.csv');
    }
}
