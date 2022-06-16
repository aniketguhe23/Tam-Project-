<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWattingAssignmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('watting_assignments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('category_id');
            $table->enum('waiting_status', array('0','1'))->default('0');
            $table->foreign('user_id',)->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id',)->references('id')->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('watting_assignments');
    }
}
