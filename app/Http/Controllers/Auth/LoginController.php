<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Auth;

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
    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    public function logout(Request $request){
        Auth::guard('web')->logout();
        return redirect('/login');
    }

    public function login(Request $request)
    {
        if(Auth::check()){
            return response()->json([
                'message' => 'Already logged in'
            ]);
        } else {
            $validation = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:8',
            ]);

            if($validation->fails()){
                return response()->json([
                    'message' => 'validation failed',
                    'data' => $validation->errors()
                ]);
            } else {
                $credentials = ['email'=> $request['email'], 'password' => $request['password']];
                if(Auth::guard('web')->attempt($credentials)){
                    return redirect()->route('hotelsIndex');
                } else {
                    return redirect()->route('home');
                }
            }
        }

        
    }
}
