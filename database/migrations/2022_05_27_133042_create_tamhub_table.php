<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTamhubTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tamhub', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('organisation_name');
            $table->integer('resource_category_id');
            $table->string('city');
            $table->longText('areas');
            $table->string('services');
            $table->longText('special_note');
            $table->bigInteger('contact_no');
            $table->string('email_id');
            $table->string('website_link');
            $table->longText('address');
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
        Schema::dropIfExists('tamhub');
    }
}
