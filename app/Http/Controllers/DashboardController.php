<?php

namespace App\Http\Controllers;

use App\Models\EnergyEvent;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->role === 'steward') {
            return redirect()->route('steward.dashboard');
        }



        // Latest power state (ignore problem events)
        $latestEvent = EnergyEvent::where('zone_id', $user->zone_id)
            ->whereIn('type', ['on', 'off'])
            ->latest()
            ->first();

        $powerStatus = $latestEvent ? $latestEvent->type : 'unknown';

        // Timeline (last 10 zone events)
        $events = EnergyEvent::where('zone_id', $user->zone_id)
            ->latest()
            ->limit(10)
            ->get();

        return view('dashboard.index', compact('powerStatus', 'events'));
    }
}
