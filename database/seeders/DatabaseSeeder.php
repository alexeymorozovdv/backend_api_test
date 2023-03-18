<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Property;
use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PropertySeeder::class);

        $colors = Property::select('*')->where(Property::PROPERTIES_NAME_FIELD_NAME, 'color')->get();
        $weights = Property::select('*')->where(Property::PROPERTIES_NAME_FIELD_NAME, 'weight')->get();

        Product::factory(125)->create()->each(function ($product) use  ($colors, $weights) {
            /** @var Product $product */
            $product->properties()->save($colors->random());
            $product->properties()->save($weights->random());
            }
        );
    }
}
