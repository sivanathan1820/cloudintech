<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\Customer;
use App\Models\Order; 
use App\Models\Card;
use Razorpay\Api\Api;
use Session;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $valid = Validator::make($request->all(),
            [
                'name'          => 'required',
                'email'         => 'required|email',
                'type'          => 'required',
                'password'      => 'required',
                'c_password'    => 'required|same:password',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input'],400);
        }

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user   = User::create($data);
        $token  = $user->createToken('accessToken')->accessToken;

        return response()->json(['message' => 'User Created Successfully','token' => $token],200);
    }

    public function login(Request $request)
    {
        $valid = Validator::make($request->all(),
            [
                'email'         => 'required|email',
                'password'      => 'required',
        ]);

        if($valid->fails())
        {
            return response()->json(['message' => 'Invalid Input'],400);
        }

        if(!Auth::attempt(['email' => $request->email,'password' => $request->password]))
        {   
            return response()->json(['message' => 'Invalid Credential'],400);
        }

        $user   = Auth::User();
        $token  = $user->createToken('accessToken')->accessToken;
        Session::put('SGtoken',$token);
        Session::put('isloged','yes');
        Session::put('logedid',$user->id);
        Session::put('logedname',$user->name);
        Session::put('logedtype','admin');
        return response()->json(['message' => 'Login Successfully','token' => $token],200);
    }

    public function logout() 
    {
        if(Auth::check()) 
        {
            Session::flush();
            Auth::user()->token()->revoke();
            return response()->json(['message' => 'Logot Successfully'],200);
        }
    }
    
    public function redirectToGoogle() 
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback() 
    {
        try 
        {
            $user       = Socialite::driver('google')->stateless()->user();
            $finduser   = User::where('email', $user->email)->first();

            if($finduser)
            {
                $customerid     = Customer::where('email', $user->email)->first()->id;
                $token          = $finduser->createToken('accessToken');
                Session::put('SGtoken',$token->accessToken);
                Session::put('isloged','yes');
                Session::put('logedid',$finduser->id);
                Session::put('logedname',$finduser->name);
                Session::put('logedtype','customer');
                Session::put('customerid',$customerid);
                return redirect()->intended('customer-dashboard');
            }
            else
            {
                $newUser = User::create([
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'password'          => Hash::make($user->name),
                    'type'              => 'customer'
                ]);

                $customer = Customer::create([
                    'name'              => $user->name,
                    'email'             => $user->email,
                    'email_verified_at' => date('Y-m-d H:i:s'),
                    'password'          => Hash::make($user->name),
                ]);

                $finduser       = User::where('email', $user->email)->first();
                $customerid     = Customer::where('email', $user->email)->first()->id;
                
                $token      = $finduser->createToken('accessToken');
                Session::put('SGtoken',$token->accessToken);
                Session::put('isloged','yes');
                Session::put('logedid',$finduser->id);
                Session::put('customerid',$customerid);
                Session::put('logedtype','customer');
                return redirect()->intended('customer-dashboard');
            }
        }
        catch (Exception $e) 
        {
            dd($e->getMessage());
        }
    }
}
