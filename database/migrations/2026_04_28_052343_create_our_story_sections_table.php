<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurStorySectionsTable extends Migration
{
    public function up()
    {
        Schema::create('our_story_sections', function (Blueprint $table) {
            $table->id();

            $table->string('title')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();

            $table->boolean('status')->default(1);
            $table->integer('sort_order')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('our_story_sections');
    }
}