<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Throwable;

class OTPController extends Controller
{
    public function showLoginView()
    {
        return view('auth.otp.login');
    }

    public function loginByOTP(Request $request)
    {
        $request->validate([
           'mobile' => [ 'required' , 'numeric']
        ]);

            $user = User::query()->where('mobile', $request->mobile )->first();
            if ($user){
                $user->update([
                    'otp' => random_int(100000 , 999999) ,
                    'login_token' => bcrypt('djfGFD12!#9dflk@j')
                ]);
            }else{
                $user = User::query()->create([
                    'mobile' => $request->mobile ,
                    'otp' => random_int(100000 , 999999) ,
                    'login_token' => bcrypt('djfGFD12!#9dflk@j') ,
                ]);
            }
                return  response()->json(['login_token' => $user->login_token]);
    }

    public function otpCheck(Request $request)
    {
        $request->validate([
           'otp' => ['required' , 'numeric']
        ]);

        $user = User::query()->where('login_token' , $request->login_token)->first();
        if ($user && $user->otp == $request->otp){
            auth()->login($user);
            return response()->json(['status' => 1]);
        }else{
            return response()->json(['errors' => ['otp' => ['کد وارد شده نادرست است.' ]]] , 422);
        }
    }
}
