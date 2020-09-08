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
    <a class="nav-link" href="{{url('/')}}" id="backRegitration1"><i class="fas fa-chevron-left"></i> Back</a>
    <a class="nav-link" href="javascript::void(0)" style="display: none" id="backRegitration2"><i
            class="fas fa-chevron-left"></i> Back</a>
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
                            <span class="invalid-feedback" role="alert" id="username_error">
                                <strong></strong>
                            </span>
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
                            <span class="invalid-feedback" role="alert" id="email_error">
                                <strong></strong>
                            </span>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control rounded-0" name="password" id="password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                            <span class="invalid-feedback" role="alert" id="password_error">
                                <strong></strong>
                            </span>
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
                                <input type="text" class="form-control rounded-0" id="first_name" name="first_name"
                                    value="{{ old('first_name') }}">
                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" class="form-control rounded-0" id="last_name" name="last_name"
                                    value="{{ old('last_name') }}">
                                @error('last_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                            {{-- <div class="form-group">
                                <label>Billing Zip Code</label>
                                <input type="text" class="form-control rounded-0" name="zip_code"
                                    value="{{ old('zip_code') }}">
                                @error('zip_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div> --}}
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

                            <div id="card-errors" style="display: none" class="alert alert-danger mt-3" role="alert">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <p>By clicking the "Start Membership" button below, you agree to our <a href="{{ url('terms-services') }}">Terms
                                    of Use</a>, <a href="{{ url('privacy-policy') }}">Privacy Statement</a>, and that you are over 18. There
                                is no need to cancel membership as there is no recurrent charges sent to your
                                account. One time purchases Only. </p>
                        </div>
                        <div class="form-group">
                            <input type="submit"
                                class="border-sn btn btn-primary border-sn bg-sn rounded-0 btn-block pt-3 pb-3"
                                value="Enter Chat Room" style="background-color: #7b27a3;" id="card-button"
                                data-secret="{{ $intent->client_secret }}">
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
            var pattern = /^\w+([-+.'][^\s]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
            if($userame != ''){
                $('#username_error strong').css('display', 'none');
                if($email != ''){
                    $('#email_error strong').css('display', 'none');
                    if(pattern.test($('#email').val())){
                        $('#email_error strong').css('display', 'none');
                        if($password != ''){
                            $('#password_error strong').css('display', 'none');
                            if($('#password').val().length >= 8){
                                $('#password_error strong').css('display', 'none');

                        $('.regisreation-first-setp').fadeOut('200');
                        $('.regisreation-second-step').fadeIn('200');
                        $('#backRegitration1').hide();
                        $('#backRegitration2').show();

                        $('#backRegitration2').click(function(){
                            $('.regisreation-first-setp').fadeIn('200');
                            $('.regisreation-second-step').fadeOut('200');
                            $('#backRegitration1').show();
                            $('#backRegitration2').hide();
                        });
                    }else{
                        $('#password_error strong').css('display', 'block');
                        $('#password_error strong').html("Password at least 8 characters ");
                    }
                    }else{
                        $('#password_error strong').css('display', 'block');
                        $('#password_error strong').html("Password can't be null");
                    }
                    }else{
                        $('#email_error strong').css('display', 'block');
                        $('#email_error strong').html("Please provide a valid email address");
                    }
                  
                }else{
                    $('#email_error strong').css('display', 'block');
                    $('#email_error strong').html("Email can't be null");
                }
            }else{
                $('#username_error strong').css('display', 'block');
                $('#username_error strong').html("Username can't be null");
            }
            
        });
            
            

    });
</script>

<script>
    const form = document.getElementById('cnw_registration_from');
    const stripe = Stripe('{{env('STRIPE_KEY')}}');
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    const cardHolderName = document.getElementById('first_name') + " " + document.getElementById('first_name');
    const cardButton = document.getElementById('card-button');
    const clientSecret = cardButton.dataset.secret;

    cardElement.mount('#card-element');

    form.addEventListener('submit', (e) => {
        e.preventDefault();
    });

    cardButton.addEventListener('click', async(e) => {
        const { setupIntent, error } = await stripe.handleCardSetup(
            clientSecret, cardElement, {
                payment_method_data: {
                    billing_details: { name: cardHolderName.value }
                }
            }
        );

        if (error) {
            console.log(error)
            $('#card-errors').show();
            $('#card-errors').html(error.message);
        } else {
            // The card has been verified successfully...
            handleStripePayment(setupIntent);
            $('#card-errors').html('');
            $('#card-errors').hide();
        }
    });

    let handleStripePayment = setupIntent => {

        let paymentInput = document.createElement('input');
        paymentInput.setAttribute('name', 'stripePaymentMethod');
        paymentInput.setAttribute('type', 'hidden');
        paymentInput.setAttribute('value', setupIntent.payment_method);
        form.appendChild(paymentInput);

        form.submit();
    }
</script>


@endsection