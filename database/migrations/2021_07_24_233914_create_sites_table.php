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
            $table->json('name');
            $table->json('description'); 
            $table->json('meta_title')->nullable();    
            $table->json('meta_description')->nullable();               
            $table->boolean('is_active')->default(0);  
            $table->boolean('is_dofollow')->nullable();  
            $table->boolean('is_free')->nullable();              
            $table->string('slug')->unique()->nullable();
            $table->string('url', 255);  
            $table->string('cover', 255)->nullable(); 
            $table->integer('spam')->nullable();    
            $table->integer('pa')->nullable();       
            $table->integer('da')->nullable();   
            $table->integer('total_links')->nullable();     
            $table->date('contact_sent')->nullable(); 
            $table->date('contact_response')->nullable();    
            $table->json('about_response')->nullable();   
            $table->integer('price')->nullable();       
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
