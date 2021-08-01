<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(0);
            $table->text('comment');
            $table->timestamps();

            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('site_id');
            $table->foreign('site_id')
                ->references('id')
                ->on('sites');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
