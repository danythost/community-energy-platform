<?php

namespace App\Services;

use App\Models\EnergyEvent;
use Carbon\Carbon;

class EnergyReportGuard
{
    public function canReport(int $userId, int $zoneId, string $type): ?string
    {
        // Rule 1: Cooldown
        $lastUserEvent = EnergyEvent::where('user_id', $userId)
            ->latest()
            ->first();

        if ($lastUserEvent && $lastUserEvent->created_at->gt(now()->subMinutes(3))) {
            return 'Please wait a few minutes before reporting again.';
        }

        // Rule 2: Duplicate state
        if (
            $lastUserEvent &&
            $lastUserEvent->zone_id === $zoneId &&
            $lastUserEvent->type === $type &&
            $type !== 'problem'
        ) {
            return 'You already reported this status.';
        }

        return null; // allowed
    }
}
