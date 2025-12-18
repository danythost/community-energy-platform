<?php
namespace App\Http\Controllers;

use App\Models\EnergyEvent;
use Illuminate\Http\Request;
use App\Services\EnergyReportGuard;

class EnergyEventController extends Controller
{
   public function store(Request $request, EnergyReportGuard $guard)
{
    $request->validate([
        'type' => 'required|in:on,off,problem',
        'description' => 'nullable|string|max:1000',
    ]);

    $user = auth()->user();

    $error = $guard->canReport(
        $user->id,
        $user->zone_id,
        $request->type
    );

    if ($error) {
        return back()->withErrors(['report' => $error]);
    }

    EnergyEvent::create([
        'user_id' => $user->id,
        'zone_id' => $user->zone_id,
        'type' => $request->type,
        'description' => $request->description,
    ]);

    return back()->with('status', 'Report submitted.');
}
    
}
