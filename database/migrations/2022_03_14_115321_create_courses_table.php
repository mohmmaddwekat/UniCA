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
            $table->string('track')->nullable();
            $table->integer('year');
            $table->integer('semester');
            $table->foreignId('headDepartment_id')->nullable()->constrained('users', 'id')->nullOnDelete();
            $table->foreignId('department_id')->nullable()->constrained('departments', 'id')->nullOnDelete();
            $table->foreignId('prerequisite')->default(0)->constrained('courses', 'id')->nullOnDelete();
            $table->primary(['id', 'prerequisite']);
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
