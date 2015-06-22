<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;



class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    //default is '/home';
    protected $redirectTo = '/';
    
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            //'name' => 'required|max:255',
            'first_name' => 'required|max:64',
            'last_name' => 'required|max:64',
            'user_name' => 'required|max:32|unique:users',
            'email' => 'required|email|max:100|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data, Request $request)
    {
       
        //$request->setTrustedProxies(array('127.0.0.1')); // only trust proxy headers coming from the IP addresses on the array (change this to suit your needs)
       // $ip = $request->getClientIp();

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'user_name' => $data['user_name'],
            'current_sign_in_ip' => $request->ip(),
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }
    
    public function postLogin(Request $request)
    {
        $this->validate($request, [
           'email' => 'required|email', 'password' => 'required',
           // 'user_name' => 'required', 'password' => 'required',
        ]);

        $credentials = $this->getCredentials($request);

        if (Auth::attempt($credentials, $request->has('remember'))) {
            
            $user = Auth::user();
            $user->last_login_at = Carbon::now();
            $user->last_sign_in_ip =  $user->current_sign_in_ip; 
            $user->current_sign_in_ip = $request->ip();
            $user->sign_in_count++; 
                    
            $user->save();
            
            return redirect()->intended($this->redirectPath())->with('success', 'You have successfully signed in!');
        }

        return redirect($this->loginPath())
            ->withInput($request->only('email', 'remember'))
            ->withErrors([
                'email' => $this->getFailedLoginMessage(),
            ]);
    }

    public function getLogout()
    {
        Auth::logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/')->with('success', 'You have successfully logged out!');
    }
    
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }

        Auth::login($this->create($request->all(),$request));

        return redirect($this->redirectPath());
    }
}
