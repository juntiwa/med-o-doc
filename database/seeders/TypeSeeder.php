<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
         ['typeid' => '0', 'typename' => 'ในภาค'],
         ['typeid' => '3', 'typename' => 'นอกภาค'],
      ];

        foreach ($types as $type) {
            Type::create($type);
        }
    }
}
