<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
// use App\Notifications\VerifyEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use DB;
use Mail;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // public function verify($token)
    // {
    //     $user = User::where('token',$token)->firstOrFail();

    //     $user->update(['token' => null]);

    //     return redirect('/home')->with('success','Account');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
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
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            // 'token' => str_random(25),
        ]);


        // $user->notify(new VerifyEmail($user));

        // return $user;
    }

    public function register(Request $request)
    {
        $input = $request->all();
        $validator = $this->validator($input)->validate();

        //if($validator->passes()){
            $user = $this->create($input)->toArray();
            $user['link'] = str_random(30);

            DB::table('users_activations')->insert(['id_user' => $user['id'], 'token' => $user['link']]);
            Mail::send('mail.useractivation', $user, function($message) use ($user){
                $message->to($user['email']);
                $message->subject('Book-a-Cab - Activation Code');
            });
            return redirect()->to('login')->with('Success',"We sent activation code, please check your email");
        //}
        //return back()->with('Error', $validator->errors());
    }

    public function userActivation($token)
    {
        $check = DB::table('users_activations')->where('token', $token)->first();
        if(!is_null($check)) 
        {
            $user = User::find($check->id_user);
            if($user->is_activated == 1)
            {
                return redirect()->to('login')->with('Success', "User are already activated");
            }
            $user->update(['is_activated' => 1]);
            //$user->update(['admin_id' => 1]);
            DB::table('users_activations')->where('token', $token)->delete();
            return redirect()->to('login')->with('Success', "User active successfully");
        }
        return redirect()->to('login')->with('warning', "Your token is invalid");
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }
}
