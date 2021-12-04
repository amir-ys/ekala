<?php

namespace App\Http\Controllers\Panel\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\User\UserRequest;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        if (\Request()->ajax()){
            $users = User::latest()->get();
            return  DataTables::of($users)
                ->addColumn('action', function ($user) {
                    return  '<a class="btn btn-sm bg-transparent d-inline"
                   href="'.route('panel.users.edit',$user->id). '"><i class="fas fa-pen fa-15m text-success"></i></a>
                  <a onclick="deleteItem(event ,   '.  "'" .route('panel.users.destroy' , $user->id). "'"  .'   )" class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                   class="fas fa-trash fa-15m text-danger"></i></a>' ;
                })->addColumn('status', function ($user) {
                    if(is_null($user->status))  {$cssClass=  'danger';} else {$cssClass =  'success';}
                    if(is_null($user->status))  {$body=  'غیر فعال';} else {$body =  'فعال';}
                    return "<span class=\"badge py-1 bg-$cssClass\"> $body </span>" ;
                })->addColumn('expireDate', function ($user) {
                    $expireCssStyle = time() > $user->expireDate ? 'color : red' : '' ;
                    return '<span style=" ' .$expireCssStyle. ' ">
                    '. date('d-m-Y',$user->expireDate) .' </span>' ;
                })->addColumn('email_verified_at' , function ($user) {
                    if(is_null($user->email_verified_at))  {$cssClass=  'danger';} else {$cssClass =  'success';}
                    if(is_null($user->email_verified_at))  {$body=  'تایید نشده';} else {$body =  'تایید شده';}
                   return  "<span class=\"badge py-1 bg-$cssClass\"> $body </span>" ;
                })->rawColumns([ 'email_verified_at' , 'status' , 'action'])
                ->make(true);
        }
        return view('panel.users.index' );
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
