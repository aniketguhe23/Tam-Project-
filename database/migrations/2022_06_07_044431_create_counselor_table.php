<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselor', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('counselor_name');
            $table->unsignedBigInteger('category_id');
            $table->string('email')->unique();
            $table->string('password');      
            $table->string('phone_no');
            $table->string('topic');
            $table->integer('feedback_id');
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
        Schema::dropIfExists('counselor');
    }
}
