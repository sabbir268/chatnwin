@extends('layouts.frontend.layout')
@section('header')
<title>Sneakly</title>
<style>
    .registration-form {
        padding-bottom: 80px;
    }

    .regisreation-second-step {
        display: none;
    }

    .reg-first-alert {
        display: none;
    }

    /** stripe css **/
    /**
    * The CSS shown here will not be introduced in the Quickstart guide, but shows
    * how you can use CSS to style your Element's container.
    */
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid #ced4da;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }

    .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
    }

    .StripeElement--invalid {
        border-color: #fa755a;
    }

    .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
    }

</style>

<script src="https://js.stripe.com/v3/"></script>
@endsection
@section('menu-item')
<li class="nav-item">
    <a class="nav-link" href="{{ url('/') }}"><i class="fas fa-chevron-left"></i> Back</a>
</li>
@endsection
@section('content')
<div class="container">
    <div class="registration-form mt-3 text-left">
        <form action="{{ route('register') }}" method="POST" id="cnw_registration_from">
            @csrf
            <div class="regisreation-first-setp" id="first-step">
                <div class="registration-header text-center">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h1 class="font-weight-bold">$1</h1>
                            <h6>Pay $1 to access the chat room and at the end of the week one lucky person will win the
                                exclusive item that the room was about </h6>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 offset-md-4">
                        <div class="alert alert-danger bg-danger text-info reg-first-alert"></div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control rounded-0" name="username" id="username"
                                value="{{ old('username') }}">
                            @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control rounded-0" name="email" id="email"
                                value="{{ old('email') }}">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control rounded-0" name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group text-right">
                            <input type="button" class="btn btn-primary rounded-0 border-sn bg-snw pl-5 pr-5 pt-2 pb-2"
                                value="Continue" id="reg_continue">
                        </div>
                    </div>
                </div>
            </div>
            <div class="regisreation-second-step" id="second-step">
                <div class="registration-header-2 text-center">
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <h1 class="font-weight-bold">Just one more step away from filling your closet!!</h1>
                        </div>
                    </div>
                </div>
                <div class="registration-form-2 mt-3">
                    <div class="row">
                        <div class="col-md-4 offset-md-4">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" class="form-control rounded-0" name="first_name"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control rounded-0" name="last_name"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Billing Zip Code</label>
                                <input type="text" class="form-control rounded-0" name="zip_code"
                                    value="{{ old('zip_code') }}">
                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Card Number</label>
                                <input type="text" class="form-control rounded-0" name="card_number"
                                    value="{{ old('card_number') }}">
                            @error('card_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Expiration Date (MM/YY)</label>
                            <input type="text" class="form-control rounded-0" name="expiration_date"
                                value="{{ old('expiration_date') }}">
                            @error('expiration_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Security Code (CVV)</label>
                            <input type="text" class="form-control rounded-0" name="security_code"
                                value="{{ old('security_code') }}">
                            @error('security_code')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <p>By clicking the "Start Membership" button below, you agree to our <a
                                    href="{{ url('terms-services') }}">Terms
                                    of Use</a>, <a href="{{ url('privacy-policy') }}">Privacy Statement</a>, and
                                that you are over 18. There
                                is no need to cancel membership as there is no recurrent charges sent to your
                                account. One time purchases Only. </p>
                        </div> --}}
                        <div class="form-group">
                            <label for="card-element">
                                Credit or debit card
                            </label>
                            <div id="card-element">
                                <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <div class="form-group">
                            <input type="submit"
                                class="border-sn btn btn-primary border-sn bg-snw rounded-0 btn-block pt-3 pb-3"
                                value="Enter Chat Room">
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
</div>

</div>
@endsection


@section('script')
<script>
    $(document).ready(function(){
        $(document).on('click', '#reg_continue', function(e){
            e.preventDefault();
            $userame = $('#username').val();
            $email = $('#email').val();
            $password = $('#password').val();
            if($userame != ''){
                if($email != ''){
                    if($password != ''){
                        $('.regisreation-first-setp').fadeOut('200');
                        $('.regisreation-second-step').fadeIn('200');
                    }else{
                        $('.reg-first-alert').css('display', 'block');
                        $('.reg-first-alert').html("Password cann't be null");
                    }
                }else{
                    $('.reg-first-alert').css('display', 'block');
                    $('.reg-first-alert').html("Email cann't be null");
                }
            }else{
                alert("Username cann't be null");
                $('.reg-first-alert').css('display', 'block');
                $('.reg-first-alert').html("Username cann't be null");
            }
        });
    });
</script>

<script>
    // Create a Stripe client.
    var stripe = Stripe('{{env('STRIPE_KEY')}}');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    // Handle form submission.
    var form = document.getElementById('cnw_registration_from');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('cnw_registration_from');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }
</script>


@endsection