<?php

namespace Database\Seeders;

use App\Models\Property;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 5; $i <= 1000; $i += 5) {
            DB::table(Property::PROPERTIES_TABLE_NAME)->insert([
                'name' => 'weight',
                'value' => $i,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $colors = ['red', 'white', 'black', 'green', 'blue', 'brown'];
        foreach ($colors as $color) {
            DB::table(Property::PROPERTIES_TABLE_NAME)->insert([
                'name' => 'color',
                'value' => $color,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
