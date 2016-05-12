<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSentEmailsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('sent_emails', function (Blueprint $table) {
            $table -> increments('id') -> unsigned();
            $table -> text('to_emails');
            $table -> string('from_email') -> nullable() -> default(NULL);
            $table -> string('template');
            $table -> string('title');
            $table -> text('params');
            $table -> text('to_cc_emails') -> nullable() -> default(NULL);
            $table -> text('to_bcc_emails') -> nullable() -> default(NULL);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('sent_emails');
    }

}
