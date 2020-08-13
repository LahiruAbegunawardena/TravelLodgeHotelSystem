<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;
use Auth;

class CustomerApiController extends Controller
{
    public function registerCustomer(Request $data){
        try {
            $validation = Validator::make($data->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:customers',
                'password' => 'required|string|min:8'
            ]);
            if($validation->fails()){
                return response()->json([
                    'status' => false, 
                    'message' => 'validation failed',
                    'data' => $validation->errors()
                ]); 
            }
            else{
                $newCustomer = Customer::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'contact_no_1' => $data['contact_no_1'],
                    'contact_no_2' => $data['contact_no_2'],
                    'password' => bcrypt($data['password'])
                ]);
                return response()->json([
                    'status' => true, 
                    'data' => $newCustomer,
                    'message' => 'Customer Registered Successfully..'
                ]);

            }
        } catch (QueryException $e){
            return response()->json([
                'status' => false,
                'message' => 'Exception Occured',
                'data' => $e->getMessage()
            ]);
        }
    }

    public function loginCustomer(Request $request){
        
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
            $slctdCustomer = Customer::where(["email" => $request->email])->get();
            if(isset($slctdCustomer)){
                if (! $token = auth()->attempt($request->all())) {
                    return response()->json(['token' => $token, 'message' => 'Your Credentials are wrong..']);
                }

                return response()->json([
                    'status' => true,
                    'token_type' => 'bearer',
                    'access_token' => $token,
                    'userData' => $slctdCustomer
                ]);
            } else {
                return response()->json(['token' => $token, 'message' => 'Your Credentials are wrong..']);
            }
       
        }
        
    }

    public function profile()
    {
        try {
            return response()->json(['customer_profile' => Auth::guard('api')->user()]);
        } catch (Exception $ex) {
            return response()->json([
                "message" => "Exception occured",
                "exception" => $ex->getMessage()
            ]);
        }
        
    }

    public function logout(){
        try {
            Auth::logout();
            return response()->json(['message' => 'Successfully logged out']);
        } catch (Exception $ex){
            dd($ex->getMessage());
        }
        
    }
}
