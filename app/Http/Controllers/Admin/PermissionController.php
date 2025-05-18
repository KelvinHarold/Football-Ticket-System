<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Faker\Provider\ar_EG\Person;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('admin.permissions.index' , compact('permissions'));
    }

    public function create(){
        return view('admin.permissions.create');
    }

    public function store(Request $request ){
        $data = $request->validate([
            'name'=>'required'
        ]);

        Permission::create($data);
        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission){
        $roles = Role::all();
        return view('admin.permissions.edit', compact('permission', 'roles'));  
    }

    public function update(Request $request, Permission $permission){
        $data = $request->validate([
            'name'=>'required',
        ]);

        $permission->update($data);
        return to_route('admin.permissions.index');
    }

    public function destroy(Permission $permission){
        $permission->delete();

        return to_route("admin.permissions.index");
    }


    public function assignrole(Request $request, Permission $permission){
        if ($permission->hasRole($request->role)) {
            return back()->with('error', 'Role already assigned to this role.');
        }
        $permission->assignRole($request->role);
        return back()->with('success', 'Role assigned to role successfully.'); 
    }

    public function removeRole(Permission $permission, Role $role){
        if ($permission->hasRole($role)) {
            $permission->removeRole($role);
            return back()->with('error', 'Role removed from this permission.');
        }
        
        return back()->with('success', 'Role not exisr.'); 
    }
}
