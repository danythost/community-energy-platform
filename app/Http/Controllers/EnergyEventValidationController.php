<?php

namespace App\Http\Controllers;

use App\Models\EnergyEvent;
use Illuminate\Http\Request;

class EnergyEventValidationController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->validate([
            'energy_event_id' => 'required|exists:energy_events,id',
            'decision' => 'required|in:confirmed,rejected',
        ]);

        $event = EnergyEvent::findOrFail($request->energy_event_id);
        
        // Ensure only pending events can be validated (optional safety)
        if ($event->status !== 'pending') {
            return back()->with('error', 'This event has already been validated.');
        }

        $event->update([
            'status' => $request->decision,
        ]);

        return back()->with('status', 'Event has been ' . $request->decision . '.');
    }
}
