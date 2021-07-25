<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->json('name');
            $table->string('abbrev', 150);
            $table->json('slug')->unique()->nullable();
            $table->boolean('is_active');
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('lft')->default(0); 
            $table->integer('rgt')->default(0);  
            $table->integer('depth')->default(0);                 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
