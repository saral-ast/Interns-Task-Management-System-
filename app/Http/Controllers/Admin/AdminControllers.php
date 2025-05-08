<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminRequest;
    use App\Models\Admin;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
    use Exception;
    use Illuminate\Support\Facades\Log;

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
                $permissions = \App\Models\Permission::all();
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
                $admin = Admin::create($credentials);

                // Get all permissions and create role permission entries
                $permissions = \App\Models\Permission::all();
                if ($request->has('permissions')) {
                    foreach ($request->permissions as $permissionId) {
                    \App\Models\RolePermssion::create([
                            'admin_id' => $admin->id,
                            'permission_id' => $permissionId
                        ]);
                }}

                return redirect()->route('admin.admins')->with('success', 'Administrator created successfully with all permissions.');
            } catch (Exception $e) {
                Log::error('Error creating admin: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while creating the administrator. Please try again.')
                    ->withInput($request->except('password'));
            }
        }

        public function edit(Admin $admin) {
            try {
                $permissions = \App\Models\Permission::all();
                $adminPermissions = \App\Models\RolePermssion::where('admin_id', $admin->id)
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

        public function update(Request $request, Admin $admin) {
            try {
                $admin->name = $request->name;
                $admin->email = $request->email;
                
                if($request->password) {
                    $admin->password = bcrypt($request->password);
                }
                $admin->save();

                // Update permissions
                \App\Models\RolePermssion::where('admin_id', $admin->id)->delete();
                
                if($request->has('permissions')) {
                    foreach($request->permissions as $permissionId) {
                        \App\Models\RolePermssion::create([
                            'admin_id' => $admin->id,
                            'permission_id' => $permissionId
                        ]);
                    }
                }

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
                $adminPermissions = \App\Models\RolePermssion::where('admin_id', $admin->id)->delete();
                $admin->delete();
                
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