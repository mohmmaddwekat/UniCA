<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->string('name');
            $table->integer('year');
            $table->integer('semester');
            $table->primary('id');
            $table->foreignId('headDepartment_id')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('prerequisite')->nullable()->constrained('courses', 'id')->nullOnDelete();
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
        Schema::dropIfExists('courses');
    }
}
