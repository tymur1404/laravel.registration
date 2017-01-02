<?php

namespace App\Http\Controllers\Auth;

use Mail;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function index()
    {
        if(session()->has('email'))
            return view('user.users', ['users' => User::all()]);
        
        return view('user.login');
    }
    
    public function users(){
        if(session()->has('email'))
            return view('user.users', ['users' => User::all()]);

        return redirect()->route('register.index');
    }

    public function logout(){
        session()->forget('id');
        session()->forget('email');
        return redirect()->route('register.index');
    }

    public function login()
    {
        $user = new User();
        $user->login();
    }

}
