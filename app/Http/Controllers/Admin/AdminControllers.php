<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminRequest;
    use App\Models\Admin;
    use App\Models\Permission;
    use App\Models\RolePermssion;
    use Illuminate\Support\Facades\Auth;
    use Exception;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\DB;


    class AdminControllers extends Controller
    {
        public function index() {
            try {
                $admin = Admin::all();
                return view('admin.admins.index',[
                    'admins' => $admin
                ]);
            } catch (Exception $e) {
                Log::error('Error in admin index: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while loading administrators. Please try again.');
            }
        }

        public function create() {
            try {
                $permissions = Permission::all();
                return view('admin.admins.create', [
                    'permissions' => $permissions
                ]);
            } catch (Exception $e) {
                Log::error('Error in admin create view: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while loading the create form. Please try again.');
            }
        }

        public function store(AdminRequest $request) { 
            try {
                $credentials = $request->validated();
                $credentials['password'] =bcrypt($credentials['password']);
                $credentials['role_id'] = 2;
                DB::beginTransaction();
                $admin = Admin::create($credentials);

                // Get all permissions and create role permission entries
                $admin->rolePermissions()->attach($request->permissions);
                DB::commit();

                return redirect()->route('admin.admins')->with('success', 'Administrator created successfully with all permissions.');
            } catch (Exception $e) {
                Log::error('Error creating admin: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while creating the administrator. Please try again.')
                    ->withInput($request->except('password'));
            }
        }

        public function edit(Admin $admin) {
            try {
                if($admin->role->name == 'super_admin') {
                    return redirect()->route('admin.admins')->with('error', 'Super Admin cannot be edited.');
                }
                $permissions = Permission::all();
                $adminPermissions = RolePermssion::where('admin_id', $admin->id)
                    ->pluck('permission_id')
                    ->toArray();
                // dd($adminPermissions, $permissions);

                return view('admin.admins.edit', [
                    'admin' => $admin,
                    'permissions' => $permissions,
                    'adminPermissions' => $adminPermissions
                ]);
            } catch (Exception $e) {
                Log::error('Error in admin edit view: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while loading the edit form. Please try again.');
            }
        }

        public function update(AdminRequest $request, Admin $admin) {
            try {
                $credentials = $request->validated();
                
                DB::beginTransaction();
                if($request->password) {
                    $credentials['password'] = bcrypt($request->password);
                }
                
                $admin->update($credentials);
                
                // Update permissions
                $admin->rolePermissions()->detach();
                $admin->rolePermissions()->attach($request->permissions);
                DB::commit();
                return redirect()->route('admin.admins')->with('success', 'Administrator updated successfully with selected permissions.');
            } catch (Exception $e) {
                Log::error('Error updating admin: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while updating the administrator. Please try again.')
                    ->withInput($request->except('password'));
            }
        }

        public function destroy(Admin $admin)
        {
            try {
                DB::beginTransaction();
                RolePermssion::where('admin_id', $admin->id)->delete();
                $admin->delete();
                DB::commit();
                
                return response()->json([
                    'success' => true,
                    'message' => 'Administrator deleted successfully'
                ]);
            } catch (Exception $e) {
                Log::error('Error deleting admin: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while deleting the administrator'
                ], 500);
            }
        }
    }