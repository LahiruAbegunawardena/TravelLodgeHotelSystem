<?php

namespace App\Http\Controllers\Customer;

use Exception;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
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
                    'message' => 'validation failed',
                    'data' => $validation->errors()
                ]); 
            }
            else{
                $newStudent = Customer::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($data['password'])
                ]);
                return redirect()->route('home')->with('success', 'Customer Registered Successfully.. Wait for verification to login..');

            }
        } catch (QueryException $e){
            return redirect()->route('home')->with('success', 'Customer Registered Successfully.. Wait for verification to login..');

        }
    }
}
