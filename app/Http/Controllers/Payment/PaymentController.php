<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Helper\HelperController as pr;
use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\User;
use App\Models\Payment;

class PaymentController extends Controller {

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();

        // Middleware
        $this -> middleware('auth.job');
        $this -> middleware('job.post', ['only' => ['payment']]);
    }

    /**
     * Finalize
     * 
     * @return view
     */
    public function finalize(Request $request) {
        \Stripe\Stripe::setApiKey(env('STRIPE_KEY'));
        
        // If user does not have a stripe_id set, let's set it now
        if (empty($request -> session() -> get('user') -> stripe_id)) {
            try {
                // Create the customer at Stripe
                $customer = json_decode(Payment::CreateCustomer($request -> get('token'), $request -> session() -> get('user') -> id));

                // Error creating customer?
                if (!isset($customer -> error)) {
                    // Update user with payment information
                    $userUpdate = array(
                        'name' => $request -> session() -> get('user') -> name != NULL ? $request -> session() -> get('user') -> name : $request -> get('name'),
                        'last_4' => $request -> get('last_4'),
                        'exp_month' => $request -> get('month'),
                        'exp_year' => $request -> get('year'),
                        'zip' => $request -> get('zip'),
                        'stripe_id' => $customer -> id
                    );
                    User::UpdateUser($request -> session() -> get('user') -> id, $userUpdate);


                    // Set the stripe_id variable
                    $stripe_id = $customer -> id;
                } else {
                    return json_encode($customer);
                }
            } catch (\Stripe\Error\Card $e) {
                return json_encode(array(
                    'error' => $e -> getMessage()
                ));
            }
        } else {
            // Set the stripe_id variable
            $stripe_id = $request -> session() -> get('user') -> stripe_id;
        }

        // Run the payment
        $payment = json_decode(Payment::RunPayment($stripe_id, $request -> get('amount')));

        // Payment successful?
        if (!isset($payment -> error)) {

            // Save the payment
            Payment::SavePayment($payment);

            return json_encode($payment);
        } else {
            return json_encode($payment);
        }
    }

    /**
     * Payment
     * 
     * @return view
     */
    public function payment(Request $request) {
        // Validation
        $this -> validate($request, [
            'title' => 'required|min:6',
            'employer_id' => 'required|integer',
            'description' => 'required|min:6',
            'remote' => 'required|integer',
            'location' => 'required_if:remote,(0,2)',
            'daterange' => 'required'
        ]);

        // Save the job post as is
        $job = Job::CreateJob($request -> all());

        // Add the job details & billing information
        self::AddData('days_open', Job::DetermineDays($job));
        self::AddData('price', Job::DeterminePrice($job));
        self::AddData('order_num', $job -> id);
        self::AddData('stripe_id', $request -> session() -> get('user') -> stripe_id);
        
        // Determine which view to show
        if (!empty($request -> session() -> get('user') -> stripe_id)) {
            self::AddData('stripe_id', $request -> session() -> get('user') -> stripe_id);
            self::AddData('last4', $request -> session() -> get('user') -> last_4);
            self::AddData('exp_month', $request -> session() -> get('user') -> exp_month);
            self::AddData('exp_year', $request -> session() -> get('user') -> exp_year);
            self::AddData('zip', $request -> session() -> get('user') -> zip);
            
            return view('pages.payment-existing', self::$data);
        } else {
            return view('pages.payment', self::$data);
        }
    }
    
    /**
     * Success
     * 
     * @return view
     */
    public function success() {
        // Redirect to homepage
        return redirect('\\') -> with('success', 'You have successfully posted your job. Thank you!');
    }

}
