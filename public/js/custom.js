
var StripeKey = 'pk_test_ClBvdffVhy60B7K5l6oXgHED';
var envURL = 'http://localhost/pugjobs.com/public/';

$(document).ready(function () {

    // Summernote Setup
    $('.summernote').summernote({
        height: 150,
        minHeight: null,
        maxHeight: null,
        toolbar: []
    });

    // Job Creation - Remote/Location Toggle
    $(".job_create_remote_radio").bind('click', (function () {
        if ($(this).val() != 1) {
            $('.job_create_location').val('').show();
        } else {
            $('.job_create_location').val('').hide();
        }
    }));

    // Date Range Picker
    $('input[name="daterange"]').daterangepicker();

    // Payment Form
    $("#payment_submit").bind("click", (function (event) {
        $('#error_wrapper ul').empty();
        $("#error_wrapper").hide();

        // Validation
        var errors = [];
        if ($('#payment_name').val() == '') {
            errors.push('The payment name field is required.');
        }
        if ($('#payment_cc').val() == '') {
            errors.push('The credit card field is required.');
        }
        if ($('#payment_cvv').val() == '') {
            errors.push('The cvv field is required.');
        }
        if ($('#payment_month').val() == '') {
            errors.push('The exp month field is required.');
        }
        if ($('#payment_year option:selected').val() == '') {
            errors.push('The exp year field is required.');
        }
        if ($('#payment_zip').val() == '') {
            errors.push('The postal code field is required.');
        }

        if (errors.length == 0) {
            // Disable the submit button
            $('#payment_submit').hide();
            $('#payment_processing').show();

            Stripe.setPublishableKey(StripeKey);
            Stripe.card.createToken({
                number: $('#payment_cc').val(),
                cvc: $('#payment_cvv').val(),
                exp_month: $('#payment_month').val(),
                exp_year: $('#payment_year').val(),
                address_zip: $('#payment_zip').val()
            }, stripeResponseHandler);
        } else {
            $.each(errors, function (index, value) {
                $("#error_wrapper ul").append('<li>' + value + '</li>');
            });
            $("#error_wrapper").show();
        }

        event.preventDefault();
    }));
});

function stripeResponseHandler(status, response) {
    if (response.error) { // Problem!
        // Show the errors on the form
        $("#error_wrapper ul").append('<li>' + response.error.message + '</li>');
        $("#error_wrapper").show();

        // Disable the submit button
        $('#payment_submit').show();
        $('#payment_processing').hide();
    } else {

        $.ajax({
            url: envURL + 'payment/finalize',
            headers: {
                'X-CSRF-Token': $('input[name="_token"]').val()
            },
            data: {
                name: $('#payment_name').val(),
                last_4: $('#payment_cc').val().substr($('#payment_cc').val().length - 4),
                month: $('#payment_month').val(),
                year: $('#payment_year').val(),
                zip: $('#payment_zip').val(),
                token: response.id,
                amount: $('#payment_amount').val()
            },
            success: function (data) {
                console.log(data);
                data = $.parseJSON(data);

                if (data.hasOwnProperty("error")) {
                    $("#error_wrapper ul").append('<li>' + data.error + '</li>');
                    $("#error_wrapper").show();
                } else {
                    console.log(data);
                }
            },
            type: 'POST'
        });
    }
}

