<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class AdminControllers extends Controller
{
    public function index()
    {
        try {
            // Eager load only necessary fields
            $admins = Admin::with('role:id,name')->get();

            return view('admin.admins.index', compact('admins'));
        } catch (Exception $e) {
            Log::error('Error in admin index: ' . $e->getMessage());
            return back()->with('error', 'Failed to load administrators.');
        }
    }

    public function create()
    {
        try {
         
            $permissions = Permission::select('id', 'permission')->get();
           

            return view('admin.admins.create', compact('permissions'));
        } catch (Exception $e) {
            Log::error('Error in admin create view: ' . $e->getMessage());
            return back()->with('error', 'Failed to load create form.');
        }
    }

    public function store(AdminRequest $request)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            // $data['password'] = bcrypt($data['password']);
            $data['role_id'] = 2; // Default role

            $admin = Admin::create($data);
            $admin->rolePermissions()->sync($request->permissions); // Use sync instead of attach for better idempotency

            DB::commit();

            return redirect()->route('admin.admins')->with('success', 'Administrator created successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating admin: ' . $e->getMessage());

            return back()->with('error', 'Failed to create administrator.')->withInput($request->except('password'));
        }
    }

    public function edit(Admin $admin)
    {
        try {
           
            if (isSuperAdmin()) { 
                return redirect()->route('admin.admins')->with('error', 'Super Admin cannot be edited.');
            }

            $permissions = Permission::select('id', 'permission')->get();
            $admin->load('rolePermissions:id,permission'); // Only necessary columns
            $adminPermissions = $admin->rolePermissions->pluck('id')->toArray();

            return view('admin.admins.edit', compact('admin', 'permissions', 'adminPermissions'));
        } catch (Exception $e) {
            Log::error('Error in admin edit view: ' . $e->getMessage());
            return back()->with('error', 'Failed to load edit form.');
        }
    }

    public function update(AdminRequest $request, Admin $admin)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated(); 
            if (isSuperAdmin()) {
                return redirect()->route('admin.admins')->with('error', 'Super Admin cannot be edited.');
            }

            $admin->update($data);
            
            // Only update permissions if the admin is not editing themselves
            if(admin()->id != $admin->id) {
                $admin->rolePermissions()->sync($request->permissions);
            }

            DB::commit();

            return redirect()->route('admin.admins')->with('success', 'Administrator updated successfully.');
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating admin: ' . $e->getMessage());

            return back()->with('error', 'Failed to update administrator.')->withInput($request->except('password'));
        }
    }

    public function destroy(Admin $admin)
    {
        DB::beginTransaction();

        try {
            $admin->rolePermissions()->detach();
            $admin->delete();

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Administrator deleted successfully'
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting admin: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete administrator'
            ], 500);
        }
    }
}