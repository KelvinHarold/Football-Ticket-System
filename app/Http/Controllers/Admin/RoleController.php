<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function index(){
        // the admin is hidden from all users
        $roles = Role::whereNotIn('name', ['admin'])->get();
        return view('admin.roles.index', compact('roles'));
    }

    public function create(){
        return view('admin.roles.create');
    }

    public function store(Request $request ){
        $roles = $request->validate([
            'name'=>'required'
        ]);

        Role::create($roles);
        return to_route('admin.roles.index');
    }


    public function edit(Role $role){
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role','permissions'));
    }

    public function update(Request $request, Role $role){
        $data = $request->validate([
            'name'=>'required',
        ]);

        $role->update($data);
        return to_route('admin.roles.index');
    }


    public function destroy(Role $role){
        $role->delete();

        return to_route("admin.roles.index");
    }


    public function givePermission(Request $request, Role $role){
        if($role->hasPermissionTo($request->permission)){
            return back()->with('message', 'Permission exists.');
        }
        $role->givePermissionTo($request->permission);
        return back()->with('message', 'Permission added.');
    }

    public function revokePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back()->with('message', 'Permission revoked.');
        }
        return back()->with('message', 'Permission not exist.');
    }
}
