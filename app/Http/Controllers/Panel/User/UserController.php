<?php

namespace App\Http\Controllers\Panel\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\UserRequest;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('panel.users.index' , compact('users'));
    }

    public function create()
    {
        return view('panel.users.create');
    }

    public function store(UserRequest $request)
    {
       $user =  User::create([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => bcrypt($request->getPassword()) ,
        ]);
       $request->email_verified_at ? $user->markEmailAsVerified() : null;
       $user->save();

        newFeedback();
        return redirect()->route('panel.users.index');
    }

    public function edit(User $user)
    {
        return view('panel.users.edit' ,compact('user'));
    }

    public function update(UserRequest $request , User $user)
    {
        $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => bcrypt($request->getPassword()) ,
        ]);
        $request->email_verified_at ? $user->markEmailAsVerified() : null;
        return redirect()->route('panel.users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return response()->json(['message' => 'کاربر  '. $user->name.' با موفقیت  حذف شد.']);
    }
}
