<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminControllers extends Controller
{
    public function index() {
        $admin = Admin::all();
        return view('admin.admins.index',[
            'admins' => $admin
        ]);
    }

    public function create() {
        $permissions = \App\Models\Permission::all();
        return view('admin.admins.create', [
            'permissions' => $permissions
        ]);
    }

    public function store(AdminRequest $request) { 
        $credentials = $request->validated();
        $credentials['role_id'] = 2;
        $admin = Admin::create($credentials);

        // Get all permissions and create role permission entries
        $permissions = \App\Models\Permission::all();
        foreach ($permissions as $permission) {
            \App\Models\RolePermssion::create([
                'role_id' => $admin->role_id,
                'permission_id' => $permission->id
            ]);
        }

        return redirect()->route('admin.admins')->with('success', 'Administrator created successfully with all permissions.');
    }

    public function edit(Admin $admin) {
        $permissions = \App\Models\Permission::all();
        $adminPermissions = \App\Models\RolePermssion::where('role_id', $admin->role_id)
            ->pluck('permission_id')
            ->toArray();

        return view('admin.admins.edit', [
            'admin' => $admin,
            'permissions' => $permissions,
            'adminPermissions' => $adminPermissions
        ]);
    }

    public function update(Request $request, Admin $admin) {
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();

        // Update permissions
        \App\Models\RolePermssion::where('role_id', $admin->role_id)->delete();
        
        if($request->has('permissions')) {
            foreach($request->permissions as $permissionId) {
                \App\Models\RolePermssion::create([
                    'role_id' => $admin->role_id,
                    'permission_id' => $permissionId
                ]);
            }
        }

        return redirect()->route('admin.admins')->with('success', 'Administrator updated successfully with selected permissions.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return response()->json([
            'success' => true,
            'message' => 'Administrator deleted successfully'
        ]);
    }
}
