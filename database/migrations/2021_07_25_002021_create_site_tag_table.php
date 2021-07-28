<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('site_id')->nullable();
            $table->unsignedBigInteger('tag_id')->nullable();

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')->onDelete('restrict');

            $table->foreign('site_id')
                ->references('id')
                ->on('sites')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_tag');
    }
}
