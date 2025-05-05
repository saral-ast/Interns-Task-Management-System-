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
        return view('admin.admins.create');
    }

    public function store(AdminRequest $request ) { 
        $credentials = $request->validated();
        $credentials['role_id'] = 1;
        Admin::create($credentials);
        return redirect()->route('admin.admins');
    }

    public function edit(Admin $admin) {
        return view('admin.admins.edit',[
            'admin' => $admin
    ]);
    }

    public function update(Request $request, Admin $admin) {
        $admin->name = $request->name;
        $admin->email = $request->email;
        if($request->password) {
            $admin->password = bcrypt($request->password);
        }
        $admin->save();
        return redirect()->route('admin.admins');
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
