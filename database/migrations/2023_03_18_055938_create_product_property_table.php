<?php

use App\Models\Property;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_property', function (Blueprint $table) {
            $table->foreignIdFor(Product::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Property::class)->constrained()->onDelete('cascade');

            $table->index(['product_id', 'property_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_option_pivot');
    }
};
