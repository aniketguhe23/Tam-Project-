<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselorAssignmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselor_assignment', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('counselor_id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id',)->references('id')->on('category')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id',)->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('counselor_assignment');
    }
}
