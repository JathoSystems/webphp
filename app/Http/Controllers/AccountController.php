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
}
