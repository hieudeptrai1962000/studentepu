<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_id')->nullable()->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name','190');
            $table->dateTime('birthday');
            $table->string('gender','20');
            $table->string('avatar','190')->nullable();
            $table->string('phone_number','50');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
