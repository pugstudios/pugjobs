<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table -> increments('id') -> unsigned();
            $table -> string('email') -> unique();
            $table -> string('password');
            $table -> boolean('newsletter') -> default(1);
            $table -> enum('type', array('employee', 'employer', 'staff'));
            $table -> string('name') -> nullable() -> default(NULL);
            $table -> text('description') -> nullable() -> default(NULL);
            $table -> string('logo') -> nullable() -> default(NULL);
            $table -> string('stripe_id') -> nullable() -> default(NULL);
            $table -> string('last_4') -> nullable() -> default(NULL);
            $table -> string('exp_month') -> nullable() -> default(NULL);
            $table -> string('exp_year') -> nullable() -> default(NULL);
            $table -> string('zip') -> nullable() -> default(NULL);
            $table -> timestamps();
        });
    }
 
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('users');
    }

}
