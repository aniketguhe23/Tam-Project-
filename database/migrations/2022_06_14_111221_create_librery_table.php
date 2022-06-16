<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibreryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('librery', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('library_category_id');
            $table->string('link');
            $table->string('source');
            $table->string('description');
            $table->foreign('library_category_id',)->references('id')->on('library_category')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('librery');
    }
}
