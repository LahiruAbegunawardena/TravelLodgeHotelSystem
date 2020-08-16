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
                return redirect()->url('')->with('warning', json_encode($validation->errors()));

                // return response()->json([
                //     'message' => 'validation failed',
                //     'data' => 
                // ]); 
            }
            else{
                $newStudent = Customer::create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'email_verified_at' => now(),
                    'password' => bcrypt($data['password'])
                ]);
                return redirect()->url('')->with('success', 'Customer Registered Successfully..');

            }
        } catch (QueryException $e){
            return redirect()->url('')->with('warning', 'Customer Registration failed..');

        }
    }
}
