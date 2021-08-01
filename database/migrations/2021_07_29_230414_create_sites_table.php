<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name',80);
            $table->string('description', 1024);
            $table->string('meta_title', 70)->nullable();
            $table->string('meta_description', 160)->nullable();
            $table->boolean('is_active')->default(0);
            $table->boolean('is_dofollow')->nullable();
            $table->boolean('is_free')->nullable();
            $table->boolean('link_in_bio')->nullable();
            $table->boolean('link_in_comments')->nullable();
            $table->date('submitted_date')->nullable();
            $table->date('approved_date')->nullable();
            $table->string('slug')->unique()->nullable();
            $table->string('url', 255);
            $table->string('cover', 255)->nullable();
            $table->integer('spam')->nullable();
            $table->integer('pa')->nullable();
            $table->integer('da')->nullable();
            $table->integer('total_links')->nullable();
            $table->date('contact_sent')->nullable();
            $table->date('contact_response')->nullable();
            $table->text('about_response')->nullable();
            $table->integer('price')->nullable();
            $table->text('about_buy_item')->nullable();
            $table->string('analytics', 255)->nullable();
            $table->integer('parent_id')->default(0)->nullable();
            $table->integer('lft')->default(0);
            $table->integer('rgt')->default(0);
            $table->integer('depth')->default(0);
            $table->timestamps();

            $table->foreignId('category_id');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');

            $table->foreignId('approve_id');
            $table->foreign('approve_id')
                  ->references('id')
                  ->on('approves');

            $table->foreignId('user_id');
            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreignId('language_id');
            $table->foreign('language_id')
                ->references('id')
                ->on('languages');

            $table->foreignId('website_type_id');
            $table->foreign('website_type_id')
                ->references('id')
                ->on('website_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sites');
    }
}
