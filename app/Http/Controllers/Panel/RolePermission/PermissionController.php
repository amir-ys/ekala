<?php

namespace App\Http\Controllers\Panel\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\RolePermission\PermissionRequest;
use App\Models\Permission;
use Yajra\DataTables\Facades\DataTables;

class PermissionController extends Controller
{
    public function index()
    {
        if (\Request()->ajax()){
            $permissions = Permission::latest()->get();
            return  DataTables::of($permissions)
                ->addColumn('action', function ($user) {
                    return  '<a class="btn btn-sm bg-transparent d-inline"
                   href="'.route('panel.permissions.edit',$user->id). '"><i class="fas fa-pen fa-15m text-success"></i></a>
                  <a onclick="deleteItem(event ,   '.  "'" .route('panel.permissions.destroy' , $user->id). "'"  .'   )" class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                   class="fas fa-trash fa-15m text-danger"></i></a>' ;
                })->rawColumns(['action'])
                ->make(true);
        }
        return view('panel.permissions.index');
    }

    public function create()
    {
        return view('panel.permissions.create');
    }
    public function store(PermissionRequest $request)
    {
        Permission::create([
            'name' => $request->name ,
            'fa_name' => $request->fa_name ,
        ]);
        return redirect()->route('panel.permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('panel.permissions.edit' , compact('permission'));
    }

    public function update(Permission $permission, PermissionRequest $request)
    {
        $permission->update([
            'name' => $request->name ,
            'fa_name' => $request->fa_name ,
        ]);
        return redirect()->route('panel.permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        return response()->json(['message' => 'پرمیژن '.$permission->fa_name.'  حذف شد.']);
    }
}
