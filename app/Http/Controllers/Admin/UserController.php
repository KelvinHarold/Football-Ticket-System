<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class UserController extends Controller
{
  public function index(){
    $users = User::paginate(10);

    return view('admin.users.index', compact('users'));
  }

 

  public function roles()
{
    $users = User::with(['roles', 'permissions'])->get();
    return view('admin.users.roles', compact('users'));
}

public function show(User $user)
{
  $roles = Role::all();
  $permissions = Permission::all();

  return view('admin.users.roles', compact('user', 'roles', 'permissions')); 
}

public function create(){
  return view('admin.users.create');
}

public function store(Request $request){
  $data = $request->validate([
    'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|confirmed|min:8',
        'phone'=>'required',
  ]); 

  User::create([
    'name'=>$data['name'],
    'email'=>$data['email'],
    'password'=>bcrypt($data['password']),
    'phone'=>$data['phone'],
  ]);

  return redirect()->route('admin.users.index')->with('success', 'User created successfully');
}


public function assignrole(Request $request, User $user){
  if ($user->hasRole($request->role)) {
      return back()->with('error', 'Role already assigned to this role.');
  }
  $user->assignRole($request->role);
  return back()->with('success', 'Role assigned to role successfully.'); 
}

public function removeRole(User $user, Role $role){
  if ($user->hasRole($role)) {
      $user->removeRole($role);
      return back()->with('error', 'Role removed from this permission.');
  }
  
  return back()->with('success', 'Role not exisr.'); 
}


public function givePermission(Request $request, User $user){
  if($user->hasPermissionTo($request->permission)){
      return back()->with('message', 'Permission exists.');
  }
  $user->givePermissionTo($request->permission);
  return back()->with('message', 'Permission added.');
}

public function revokePermission(User $user, Permission $permission){
  if($user->hasPermissionTo($permission)){
      $user->revokePermissionTo($permission);
      return back()->with('message', 'Permission revoked.');
  }
  return back()->with('message', 'Permission not exist.');
}

public function destroy(User $user)
{
  if($user->hasRole('admin')){
      return back()->with('message', 'You cannot delete an admin user.');
  }
    $user->delete();
    return back()->with('success', 'User deleted successfully.');
}

// In UserController.php

public function updateStatus(Request $request)
{
    $user = User::find($request->user_id);  // Find user by ID
    if ($user) {
        $user->is_active = $request->is_active;  // Update the active status
        $user->save();  // Save to the database
        return response()->json(['message' => 'Status updated successfully'], 200);
    } else {
        return response()->json(['message' => 'User not found'], 404);
    }
}



}