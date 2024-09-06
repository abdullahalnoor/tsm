<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
    	try
    	{
    		$validator = Validator::make($request->all(), [
	            'name' => 'required|string|max:50',
	            'email' => 'required|email|unique:users',
	            'phone' => 'nullable|string|min:11|max:13',
	            'password' => 'required|string|min:6',
	            'confirm_password' => 'required|string|min:6|same:password',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	                'status' => false,
	                'message' => 'The given data was invalid',
	                'data' => $validator->errors()
	            ], 422);
	        }

	        $user = User::create([
	            'name' => $request->name,
	            'role' => 'user',
	            'email' => $request->email,
	            'phone' => $request->phone,
	            'password' => bcrypt($request->password),
	        ]);

            return response()->json(['status'=>true, 'message'=>'Successfully Registered', 'user'=>$user]);

    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function login(Request $request)
    {
    	try
    	{   
    		$validator = Validator::make($request->all(), [
	            'email' => 'required|email',
	            'password' => 'required|string|min:6',
	        ]);

	        if ($validator->fails()) {
	            return response()->json([
	                'status' => false,
	                'message' => 'The given data was invalid',
	                'data' => $validator->errors()
	            ], 422);
	        }

    		if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
    			$user = Auth::user();
    			$token = $user->createToken('MyApp')->plainTextToken;
    			return response()->json(['status'=>true, 'message'=>'Successfully Logged In', 'token'=>$token, 'user'=>$user]);
    		}
    		return response()->json(['status'=>true, 'message'=>'Email or Password Invalid', 'token'=>"", 'user'=>new \stdClass()]);
    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function userDetails()
    {
    	try
    	{
    		$user = user();
    		return $user;
    	}catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }

    public function logout(Request $request)
    {
        try
        {
            auth()->user()->tokens()->delete();
            return response()->json(['success' => true, 'message' => 'Successfully logged out!']);
        }catch(Exception $e){
            $code = $e->getCode();            
            return response()->json(['message'=>"Something went wrong", 'execption_code'=>$code]);
        }
    }
}
