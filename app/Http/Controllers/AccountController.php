<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

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
            'role' => 'required',
        ]);

        $user = \App\Models\User::create($request->all());

        // Assign the role to the user if the following are chosen:
        // 1. particulier
        // 2. zakelijk
        $particulier = Role::where('name', 'particulier')->first();
        $zakelijk = Role::where('name', 'zakelijk')->first();
        if ($request->role == 'particulier') {
            $user->roles()->attach($particulier);
        } elseif ($request->role == 'zakelijk') {
            $user->roles()->attach($zakelijk);
        }

        auth()->login($user);

        // If user chose zakelijk, redirect to company setup page
        if ($request->role == 'zakelijk') {
            return redirect()->route('company.create');
        }

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

        // If user chose zakelijk, redirect to company setup page
        if ($user->roles->contains('name', 'zakelijk')) {
            return redirect()->route('company.create');
        }

        return redirect()->route('account.roles');
    }

    public function destroy()
    {
        $user = auth()->user();
        $user->delete();

        return redirect()->route('home');
    }
}
