<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Auth\InternRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        // dd($users);
        return view('admin.users.index', [
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return  view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternRegisterRequest $request)
    {
        $validated = $request->validated();

        $validated['role_id'] = 2;

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role_id' => $validated['role_id'],
        ]);

        return redirect()->route('admin.interns')
            ->with('success', 'Intern created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
          return view('admin.users.edit', [
            'user' => $user
        ]);   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;

        if (!empty($validated['password'])) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('admin.interns');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully'
        ]);
    }
}