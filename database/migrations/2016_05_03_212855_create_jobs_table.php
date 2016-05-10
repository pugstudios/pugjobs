<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('jobs', function (Blueprint $table) {
            $table -> increments('id') -> unsigned();
            $table -> enum('status', array('saved', 'open', 'final'));
            $table -> integer('employer_id') -> unsigned();
            $table -> string('title');
            $table -> text('description');
            $table -> enum('remote', array(0, 1, 2));
            $table -> string('location') -> nullable() -> default(NULL);
            $table -> string('salary') -> nullable() -> default(NULL);
            $table -> datetime('start');
            $table -> datetime('end');
            $table -> timestamps();

            $table -> foreign('employer_id') -> references('id') -> on('users') -> onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('jobs');
    }

}
