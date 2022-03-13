<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('complaints_forms', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('headDepartment_id');
            $table->enum('type', ['withdraw', 'enroll']);
            $table->string('course_number');
            $table->string('section');
            $table->string('course_name');
            $table->string('teacher_name');
            $table->string('days');
            $table->string('hour');
            $table->enum('status', ['False', 'True'])->default('False');

            
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
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
        Schema::dropIfExists('complaints_forms');
    }
}
