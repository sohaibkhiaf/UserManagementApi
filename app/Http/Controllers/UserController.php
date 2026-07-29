<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // List users (accessible to all authenticated users)
    public function index()
    {
        return User::all();
    }

    // Create user (Admin only - handled by middleware)
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
            'role' => 'required|in:admin,user'
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);
    }

    // Update user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Only admin OR owner
        if (auth()->id() !== $user->id && auth()->user()->role !== 'admin') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $user->update($request->only(['name', 'email']));

        return $user;
    }

    // Delete user (Admin only - handled by middleware)
    public function destroy($id)
    {
        User::destroy($id);

        return response()->json([
            'message' => 'Deleted'
        ], 200);
    }
}

