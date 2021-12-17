<?php

namespace App\Http\Controllers\Panel\RolePermission;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\RolePermission\RoleRequest;
use App\Models\Permission;
use App\Models\Role;
use Yajra\DataTables\Facades\DataTables;

class RoleController extends Controller
{
    public function index()
    {
        if (\Request()->ajax()){
            $roles = Role::latest()->get();
            return  DataTables::of($roles)
                ->addColumn('action', function ($role) {
                    return  '<a class="btn btn-sm bg-transparent d-inline"
                   href="'.route('panel.roles.edit',$role->id). '"><i class="fas fa-pen fa-15m text-success"></i></a>
                  <a onclick="deleteItem(event ,   '.  "'" .route('panel.roles.destroy' , $role->id). "'"  .'   )" class="btn btn-sm bg-transparent d-inline delete-confirm"><i
                   class="fas fa-trash fa-15m text-danger"></i></a>' ;
                })->addColumn('permissions' , function ($role){
                    $permissions = null;
                    foreach ($role->permissions as $permission){
                        if (is_null($permission)) return $permissions = null ;
                   $permissions .=  "<li> $permission->fa_name </li>";
                    }
                   return "<ul class='list-unstyled'>" . $permissions ?? '-' ."</ul>" ;
                })
                ->rawColumns(['action' , 'permissions'])
                ->make(true);
        }
        return view('panel.roles.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('panel.roles.create' , compact('permissions'));
    }
    public function store(RoleRequest $request)
    {
       $role =  Role::create([
            'name' => $request->name ,
            'fa_name' => $request->fa_name ,
        ]);

       $role->syncPermissions($request->permissions);
        return redirect()->route('panel.roles.index');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('panel.roles.edit' , compact('role' , 'permissions'));
    }

    public function update(Role $role, RoleRequest $request)
    {
        $role->update([
            'name' => $request->name ,
            'fa_name' => $request->fa_name ,
        ]);
        $role->syncPermissions($request->permissions);
        return redirect()->route('panel.roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json(['message' => 'نقش کاربری '.$role->fa_name.'  حذف شد.']);
    }
}
