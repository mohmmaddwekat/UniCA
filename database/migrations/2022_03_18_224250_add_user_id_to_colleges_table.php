<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToCollegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('colleges', function (Blueprint $table) {
            //
            // dean_of_the_college
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users', 'id')
                ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('colleges', function (Blueprint $table) {
            //
        });
    }
}
