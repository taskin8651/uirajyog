<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('category_id')->nullable();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->longText('features')->nullable();
            $table->longText('ingredients')->nullable();
            $table->longText('usage_instruction')->nullable();

            $table->string('pack_size')->nullable();
            $table->decimal('price', 10, 2)->nullable();

            $table->boolean('status')->default(1);
            $table->boolean('is_featured')->default(0);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('category_id')
                ->references('id')
                ->on('product_categories')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}