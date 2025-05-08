<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Auth\InternRegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $users = User::all();
            // dd($users);
            return view('admin.users.index', [
                'users' => $users
            ]);
        } catch (Exception $e) {
            Log::error('Error in admin interns index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading interns. Please try again.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
           return  view('admin.users.create');
        } catch (Exception $e) {
            Log::error('Error in intern create view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the create form. Please try again.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InternRegisterRequest $request)
    {
        try {
            $validated = $request->validated();

            $validated['role_id'] = 3;

            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => bcrypt($validated['password']),
                'role_id' => $validated['role_id'],
            ]);

            return redirect()->route('admin.interns')
                ->with('success', 'Intern created successfully.');
        } catch (Exception $e) {
            Log::error('Error creating intern: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while creating the intern. Please try again.')
                ->withInput($request->except('password'));
        }
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
        try {
            return view('admin.users.edit', [
                'user' => $user
            ]);  
        } catch (Exception $e) {
            Log::error('Error in intern edit view: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while loading the edit form. Please try again.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        try {
            $user->name = $request->name;
            $user->email = $request->email;

            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }

            $user->save();

            return redirect()->route('admin.interns')->with('success', 'Intern updated successfully.');
        } catch (Exception $e) {
            Log::error('Error updating intern: ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while updating the intern. Please try again.')
                ->withInput($request->except('password'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json([
                'success' => true,
                'message' => 'User deleted successfully'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting intern: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while deleting the intern'
            ], 500);
        }
    }
}