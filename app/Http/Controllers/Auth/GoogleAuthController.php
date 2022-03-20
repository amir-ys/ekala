<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
       return Socialite::driver('google')->stateless()->redirect();
    }

    public function callback()
    {
       $google =  Socialite::driver('google')->stateless()->user();
       $user = User::query()->where('email' , $google->email)->first();
       if ($user){
           auth()->loginUsingId($user->id);
           return redirect('/');
       }else{
           User::query()->create([
               'name' => $google->name  ,
               'email' => $google->email ,
               'email_verified_at' => now()
           ]);
           return redirect('/');
       }
    }

}
