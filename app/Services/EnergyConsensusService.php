<?php

namespace App\Services;

use App\Models\EnergyValidation;

class EnergyConsensusService
{
    const QUORUM = 3;

    public function consensusReached(int $energyEventId): bool
    {
        $confirmedCount = EnergyValidation::where('energy_event_id', $energyEventId)
            ->where('decision', 'confirmed')
            ->distinct('steward_id')
            ->count('steward_id');

        return $confirmedCount >= self::QUORUM;
    }
}
