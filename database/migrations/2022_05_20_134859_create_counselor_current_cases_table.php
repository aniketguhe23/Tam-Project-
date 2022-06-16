<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCounselorCurrentCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('counselor_current_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id');
            $table->integer('task_assignment_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('task_no');
            $table->longText('topic');
            $table->longText('feedback');
            $table->foreign('category_id',)->references('id')->on('category')->onDelete('cascade');
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
        Schema::dropIfExists('counselor_current_cases');
    }
}
