<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Profile;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;

use Illuminate\Support\Facades\Mail;
use App\Mail\UserRegistered;

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
    protected $redirectTo = '/profile';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            // 'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:190|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));


        return redirect('/login')->with('msg','Register Berhasil, Untuk Bisa login Silahkan Verifikasi Akun pada Email Anda !');
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
            // 'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'token' => str_random(20),
        ]);
        $user->profile()->save(new Profile);
        $user->cart()->save(new Cart);
        $user->pesans()->attach(2);

        Mail::to($user->email)->send(new UserRegistered($user));
        return $user;
    }

    public function verify($token, $id){
        $user = User::find($id);

        if($user->token != $token){
          return redirect('/login')->with('msg','Kesalahan Token');
        }

        $user->status = 2;
        $user->save();

        $this->guard()->login($user);

        return redirect('/profile')->with('mantap', 'Selamat Akun Anda Telah Aktif');;
    }
}
