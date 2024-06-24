<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('user.home')->with('users', $data);
    }

    public function create()
    {
        return view('user.form_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255|in:owner,admin',
            'password' => 'required|string|min:8|confirmed',
            'email' => 'required|string|email|max:255|unique:users,email',
        ]);

        User::create($validated_data);

        return redirect()->route('user.index')->with('success', 'Data berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.form_edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request);
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|max:255|in:owner,admin',
            'password' => '',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $validated_data['name'];
        $user->role = $validated_data['role'];
        if ($request->filled('password')) {
            $user->password = $validated_data['password'];
        }
        $user->email = $validated_data['email'];

        $user->save();

        return redirect()->route('user.index')->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->with('success', 'Data user berhasil dihapus.');
    }
}
