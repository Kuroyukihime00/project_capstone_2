<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('role')->whereHas('role', function ($q) {
            $q->whereIn('name', ['panitia', 'keuangan']);
        })->get();

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = Role::whereIn('name', ['panitia', 'keuangan'])->get();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update(['role_id' => $request->role_id]);
        return redirect()->route('admin.users.index')->with('success', 'Role diperbarui.');
    }
}
