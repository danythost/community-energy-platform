<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;

class OnboardingController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        if ($user->initialized) {
            return redirect()->route('dashboard');
        }

        $zones = Zone::all();

        return view('onboarding.index', compact('zones'));
    }

    public function store(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'role' => 'required|in:household,shop_owner,technician',
        'zone_id' => 'required|exists:zones,id',
    ]);

    $user->role = $request->role;
    $user->zone_id = $request->zone_id;
    $user->initialized = true;
    $user->save();

    return redirect()->route('dashboard');
}

}
