<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('enquiries', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('product_id')->nullable();

            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();

            $table->string('subject')->nullable();
            $table->longText('message')->nullable();

            $table->string('status')->default('new');
            $table->boolean('is_read')->default(0);
            $table->longText('admin_note')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('enquiries');
    }
}