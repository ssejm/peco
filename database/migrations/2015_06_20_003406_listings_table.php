<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ListingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 88);
            $table->text('description');
            $table->string('category', 64);
            $table->decimal('price', 10, 2);
            $table->timestamps();

            $table->string('image_file_name', 255);
            $table->string('image_content_type', 255);
            $table->string('image_file_sizes', 64);
            
            $table->integer('user_id')->unsigned();
            //define it as a foreign key
            $table->foreign('user_id')->references('id')->on('users');

                        

                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('listings');
    }
}
