<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }
    public function __construct()
    {
        if (Auth::check() && ((!empty(Auth::user()->role) == 2))) {
            $this->redirectTo = route('admin.dashboard');
        } else {
            session()->flash('message', 'Your message');
            $this->redirectTo = '/';
        }
        $this->middleware('guest');
    }
    // protected function redirectTo()
    // {
    //     return redirect($this->redirectTo)
    //         ->with('success', ['Something']);
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);
        if (session()->has('chat_init')) {
            return redirect('chatroom/' . session()->get('chat_init'));
        }
        return $this->registered($request, $user)
            ?: redirect()->intended($this->redirectPath());
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            // 'zip_code' => ['required'],
            // 'card_number' => ['required'],
            // 'expiration_date' => ['required'],
            'stripePaymentMethod' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'username' => $data['username'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            // 'zip_code' => $data['zip_code'],
            // 'card_number' => $data['card_number'],
            // 'expiration_date' => $data['expiration_date'],
            // 'security_code' => $data['security_code'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'api_token' => Str::random(60),
        ]);

        $paymentMethodID = $data['stripePaymentMethod'];

        if ($user->stripe_id == null) {
            $user->createAsStripeCustomer();
        }

        $user->addPaymentMethod($paymentMethodID);
        $user->updateDefaultPaymentMethod($paymentMethodID);


        return $user;
    }
}
