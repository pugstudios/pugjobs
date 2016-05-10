<!-- Stored in resources/views/child.blade.php -->

@extends('pages.master')

@section('title', 'Payment - PugJobs.com')

@section('content')

<div class='container'>
    <div class="row">
        <div class="col-sm-4 col-sm-offset-2">

            <h3>Secure Payment</h3>

            <div id="error_wrapper" class="alert alert-danger">
                <ul></ul>
            </div>

            <div class='well'>
                <form id="payment_form">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="payment_amount" name="payment_amount" value="{{ number_format($price, 2) }}">

                    <div class="row">
                        <div class="col-sm-2 col-sm-offset-2 text-center"><h1><i class="fa fa-cc-visa" aria-hidden="true"></i></h1></div>
                        <div class="col-sm-2 text-center"><h1><i class="fa fa-cc-mastercard" aria-hidden="true"></i></h1></div>
                        <div class="col-sm-2 text-center"><h1><i class="fa fa-cc-discover" aria-hidden="true"></i></h1></div>
                        <div class="col-sm-2 text-center"><h1><i class="fa fa-cc-amex" aria-hidden="true"></i></h1></div>
                    </div>

                    <div class="form-group">
                        <label for="payment_name">Name On Card</label>
                        <input type="text" class="form-control" id="payment_name" name="payment_name" placeholder="">
                    </div>

                    <div class="form-group">
                        <label for="payment_cc">Card Number</label>
                        <input type="text" class="form-control" id="payment_cc" name="payment_cc" placeholder="">
                    </div>

                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="payment_month">Exp Month</label>
                                <select id="payment_month" name="payment_month" class="form-control">
                                    <option value="">---</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="payment_year">Exp Year</label>
                                <select id="payment_year" name="payment_year" class="form-control">
                                    <option value="">---</option>
                                    @for ($i = 0; $i < 15; $i++)
                                    <option value="{{ date('Y', strtotime('+' . $i . ' years')) }}">{{ date('Y', strtotime('+' . $i . ' years')) }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="payment_cvv">CVV</label>
                                <input type="text" class="form-control" id="payment_cvv" name="payment_cvv" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="payment_zip">ZIP/Postal Code</label>
                        <input type="text" class="form-control" id="payment_zip" name="payment_zip" placeholder="">
                    </div>

                    <p class='small'>By continuing you agree to PugJobs.com <a href='#'>Terms & Notices</a>, <a href='#'>Privacy & Security</a>, and the use of cookies.</p>
                    <button id="payment_submit" type="button" class="btn btn-success btn-lg btn-block"><i class="fa fa-lock" aria-hidden="true"></i>&nbsp;Pay ${{ number_format($price, 2) }}</button>
                    <button id="payment_processing" type="button" class="processing btn btn-default btn-lg btn-block"><i class="fa fa-cog fa-spin fa-fw margin-bottom"></i>&nbsp; Processing Payment...</button>&nbsp;
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <button type="button" class="btn btn-primary btn-lg btn-block">Total Due: ${{ number_format($price, 2) }}</button>

            <hr/>

            <strong>Order #{{ $order_num }}</strong>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="text-right">Price</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $days_open }} days @ ${{ env('PRICE_PER_DAY') }} per day</td>
                        <td class="text-right">${{ number_format($price, 2) }}</td>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td class="text-right"><strong>Total: ${{ number_format($price, 2) }}</strong></td>
                    </tr>
                </tfoot>
            </table>
            <hr/>

            <p>
                When you hire your candidate, use the <strong>Cancel Job Posting</strong> option from your Job Listings in order to close out the job posting.
                You will be refunded for any time not used.
            </p>
            <p>
                Thank you again for using PugJobs.com for your recruiting needs!
            </p>
        </div>
    </div>
</div>

@endsection