<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->length(100);
            $table->string('middle_name')->length(100)->nullable();
            $table->string('last_name')->length(100);
            $table->smallInteger('age')->length(3);
            $table->string('sex')->length(6);
            $table->text('complete_address');
            $table->string('contact_number');
            $table->date('date_of_birth')->nullable();
            $table->smallInteger('division')->length(2);
            $table->smallInteger('section')->length(2);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
