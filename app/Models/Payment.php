<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Helper\HelperController as pr;

class Payment extends Model {

    protected $fillable = [
        'id', 'object', 'amount', 'amount_refunded', 'application_fee', 'balance_transaction',
        'captured', 'created', 'currency', 'customer', 'description', 'destination',
        'dispute', 'failure_code', 'failure_message', 'fraud_details', 'invoice',
        'livemode', 'metadata', 'order', 'paid', 'receipt_email', 'receipt_number',
        'refunded', 'refunds_object', 'refunds_data', 'refunds_has_more', 'refunds_total_count',
        'refunds_url', 'shipping', 'source_id', 'source_object', 'source_address_city',
        'source_address_country', 'source_address_line1', 'source_address_line1_check',
        'source_address_line2', 'source_addres_state', 'source_address_zip', 'source_address_zip_check',
        'source_brand', 'source_country', 'source_customer', 'source_cvc_check',
        'source_dynamic_last4', 'source_exp_month', 'source_exp_year', 'source_fingerprint',
        'source_funding', 'source_last4', 'source_metadata', 'source_name', 'source_tokenization_method',
        'source_transfer', 'statement_descriptor', 'status'
    ];
    protected $hidden = [];
    protected $table = 'transactions';

    /**
     * ConvertToCents
     * 
     * @param decimal $amount
     * @return integer
     */
    private static function ConvertToCents($amount) {
        return $amount * 100;
    }

    /**
     * CreateCustomer
     * 
     * @param string $token
     * @param integer $user_id
     * @return type
     */
    public static function CreateCustomer($token, $user_id) {
        try {
            // Get the user
            $user = User::where('id', $user_id) -> first();

            return json_encode(\Stripe\Customer::create(array(
                        "source" => $token,
                        "description" => $user -> email . " - " . $user -> id . " - " . time(),
                        "email" => $user -> email
            )));
        } catch (\Stripe\Error\InvalidRequest $e) {
            return json_encode(array(
                'error' => $e -> getMessage()
            ));
        }
    }

    /**
     * RunPayment
     * 
     * @param string $stripe_id
     * @param decimal $amount
     * @param string $currency
     * @return type
     */
    public static function RunPayment($stripe_id, $amount, $currency = 'usd') {
        try {
            // Get the user
            $user = User::where('stripe_id', $stripe_id) -> first();

            return json_encode(\Stripe\Charge::create(array(
                        "amount" => self::ConvertToCents($amount),
                        "currency" => $currency,
                        "customer" => $stripe_id
            )));
        } catch (\Stripe\Error\InvalidRequest $e) {
            return json_encode(array(
                'error' => $e -> getMessage()
            ));
        }
    }

    public static function SavePayment($payment) {
        $trans = new Payment();
        $trans -> id = $payment -> id;
        $trans -> object = $payment -> object;
        $trans -> amount = $payment -> amount;
        $trans -> amount_refunded = $payment -> amount_refunded;
        $trans -> application_fee = $payment -> application_fee;
        $trans -> balance_transaction = $payment -> balance_transaction;
        $trans -> captured = $payment -> captured;
        $trans -> created = $payment -> created;
        $trans -> currency = $payment -> currency;
        $trans -> customer = $payment -> customer;
        $trans -> description = $payment -> description;
        $trans -> destination = $payment -> destination;
        $trans -> dispute = $payment -> dispute;
        $trans -> failure_code = $payment -> failure_code;
        $trans -> failure_message = $payment -> failure_message;
        $trans -> fraud_details = json_encode($payment -> fraud_details);
        $trans -> invoice = $payment -> invoice;
        $trans -> livemode = $payment -> livemode;
        $trans -> metadata = json_encode($payment -> metadata);
        $trans -> order = $payment -> order;
        $trans -> paid = $payment -> paid;
        $trans -> receipt_email = $payment -> receipt_email;
        $trans -> receipt_number = $payment -> receipt_number;
        $trans -> refunded = $payment -> refunded;
        $trans -> refunds_object = $payment -> refunds -> object;
        $trans -> refunds_data = json_encode($payment -> refunds -> data);
        $trans -> refunds_has_more = $payment -> refunds -> has_more;
        $trans -> refunds_total_count = $payment -> refunds -> total_count;
        $trans -> refunds_url = $payment -> refunds -> url;
        $trans -> shipping = $payment -> shipping;
        $trans -> source_id = $payment -> source -> id;
        $trans -> source_object = $payment -> source -> object;
        $trans -> source_address_city = $payment -> source -> address_city;
        $trans -> source_address_country = $payment -> source -> address_country;
        $trans -> source_address_line1 = $payment -> source -> address_line1;
        $trans -> source_address_line1_check = $payment -> source -> address_line1_check;
        $trans -> source_address_line2 = $payment -> source -> address_line2;
        $trans -> source_address_state = $payment -> source -> address_state;
        $trans -> source_address_zip = $payment -> source -> address_zip;
        $trans -> source_address_zip_check = $payment -> source -> address_zip_check;
        $trans -> source_brand = $payment -> source -> brand;
        $trans -> source_country = $payment -> source -> country;
        $trans -> source_customer = $payment -> source -> customer;
        $trans -> source_cvc_check = $payment -> source -> cvc_check;
        $trans -> source_dynamic_last4 = $payment -> source -> dynamic_last4;
        $trans -> source_exp_month = $payment -> source -> exp_month;
        $trans -> source_exp_year = $payment -> source -> exp_year;
        $trans -> source_fingerprint = $payment -> source -> fingerprint;
        $trans -> source_funding = $payment -> source -> funding;
        $trans -> source_last4 = $payment -> source -> last4;
        $trans -> source_metadata = json_encode($payment -> source -> metadata);
        $trans -> source_name = $payment -> source -> name;
        $trans -> source_tokenization_method = $payment -> source -> tokenization_method;
        $trans -> source_transfer = $payment -> source_transfer;
        $trans -> statement_descriptor = $payment -> statement_descriptor;
        $trans -> status = $payment -> status;
        $trans -> save();
    }

}
