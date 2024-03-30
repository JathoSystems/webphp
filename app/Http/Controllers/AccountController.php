<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.roles', [
            'roles' => auth()->user()->roles,
        ]);
    
    }

    public function editRoles()
    {
        return view('account.editroles', [
            'roles' => \App\Models\Role::all(),
            'userRoles' => auth()->user()->roles->pluck('id')->toArray(),
        ]);
    }

    public function updateRoles(Request $request)
    {
        $user = auth()->user();
        $user->roles()->sync($request->roles);

        return redirect()->route('account.roles');
    }

    public function login()
    {
        return view('account.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function register()
    {
        return view('account.register');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('home');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = \App\Models\User::create($request->all());

        auth()->login($user);

        return redirect()->route('home');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user = auth()->user();
        $user->update($request->all());

        return redirect()->route('account.roles');
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->delete();

        return redirect()->route('home');
    }
}
