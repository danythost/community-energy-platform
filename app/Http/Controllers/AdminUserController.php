<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminUserController extends Controller
{
    public function create()
    {
        $zones = Zone::all();
        return view('admin.users.create', compact('zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'in:household,shop_owner,technician,steward'], // Added steward to allowed roles
            'zone_id' => ['required', 'exists:zones,id'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password ?? 'password'), // Default password if empty
            'role' => $request->role,
            'zone_id' => $request->zone_id,
            'initialized' => true, // Auto-initialize since admin created them
        ]);

        return redirect()->route('steward.dashboard')->with('status', 'User created successfully.');
    }
}
