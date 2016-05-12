<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration {

    public function up() {
        Schema::create('transactions', function (Blueprint $table) {
            $table -> string('id') -> nullable() -> default(NULL);
            $table -> string('object') -> nullable() -> default(NULL);
            $table -> string('amount') -> nullable() -> default(NULL);
            $table -> string('amount_refunded') -> nullable() -> default(NULL);
            $table -> string('application_fee') -> nullable() -> default(NULL);
            $table -> string('balance_transaction') -> nullable() -> default(NULL);
            $table -> string('captured') -> nullable() -> default(NULL);
            $table -> string('created') -> nullable() -> default(NULL);
            $table -> string('currency') -> nullable() -> default(NULL);
            $table -> string('customer') -> nullable() -> default(NULL);
            $table -> string('description') -> nullable() -> default(NULL);
            $table -> string('destination') -> nullable() -> default(NULL);
            $table -> string('dispute') -> nullable() -> default(NULL);
            $table -> string('failure_code') -> nullable() -> default(NULL);
            $table -> string('failure_message') -> nullable() -> default(NULL);
            $table -> string('fraud_details') -> nullable() -> default(NULL);
            $table -> string('invoice') -> nullable() -> default(NULL);
            $table -> string('livemode') -> nullable() -> default(NULL);
            $table -> string('metadata') -> nullable() -> default(NULL);
            $table -> string('order') -> nullable() -> default(NULL);
            $table -> string('paid') -> nullable() -> default(NULL);
            $table -> string('receipt_email') -> nullable() -> default(NULL);
            $table -> string('receipt_number') -> nullable() -> default(NULL);
            $table -> string('refunded') -> nullable() -> default(NULL);
            $table -> string('refunds_object') -> nullable() -> default(NULL);
            $table -> string('refunds_data') -> nullable() -> default(NULL);
            $table -> string('refunds_has_more') -> nullable() -> default(NULL);
            $table -> string('refunds_total_count') -> nullable() -> default(NULL);
            $table -> string('refunds_url') -> nullable() -> default(NULL);
            $table -> string('shipping') -> nullable() -> default(NULL);
            $table -> string('source_id') -> nullable() -> default(NULL);
            $table -> string('source_object') -> nullable() -> default(NULL);
            $table -> string('source_address_city') -> nullable() -> default(NULL);
            $table -> string('source_address_country') -> nullable() -> default(NULL);
            $table -> string('source_address_line1') -> nullable() -> default(NULL);
            $table -> string('source_address_line1_check') -> nullable() -> default(NULL);
            $table -> string('source_address_line2') -> nullable() -> default(NULL);
            $table -> string('source_address_state') -> nullable() -> default(NULL);
            $table -> string('source_address_zip') -> nullable() -> default(NULL);
            $table -> string('source_address_zip_check') -> nullable() -> default(NULL);
            $table -> string('source_brand') -> nullable() -> default(NULL);
            $table -> string('source_country') -> nullable() -> default(NULL);
            $table -> string('source_customer') -> nullable() -> default(NULL);
            $table -> string('source_cvc_check') -> nullable() -> default(NULL);
            $table -> string('source_dynamic_last4') -> nullable() -> default(NULL);
            $table -> string('source_exp_month') -> nullable() -> default(NULL);
            $table -> string('source_exp_year') -> nullable() -> default(NULL);
            $table -> string('source_fingerprint') -> nullable() -> default(NULL);
            $table -> string('source_funding') -> nullable() -> default(NULL);
            $table -> string('source_last4') -> nullable() -> default(NULL);
            $table -> string('source_metadata') -> nullable() -> default(NULL);
            $table -> string('source_name') -> nullable() -> default(NULL);
            $table -> string('source_tokenization_method') -> nullable() -> default(NULL);
            $table -> string('source_transfer') -> nullable() -> default(NULL);
            $table -> string('statement_descriptor') -> nullable() -> default(NULL);
            $table -> string('status') -> nullable() -> default(NULL);
            $table -> timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('transactions');
    }

}
