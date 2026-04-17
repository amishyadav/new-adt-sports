<?php

namespace App\Support;

use App\Models\TeamMatchScore;
use Illuminate\Support\Facades\Cache;

class MatchStateStore
{
    public static function timerCacheKey(int $scoreId): string
    {
        return 'match_timer_state:' . $scoreId;
    }

    public static function defaultTimerState(): array
    {
        return [
            'main_timer_seconds' => 1200,
            'raid_timer_seconds' => 30,
            'active_side' => 'none',
            'main_running' => false,
            'raid_running' => false,
            'synced_at_ms' => (int) round(microtime(true) * 1000),
        ];
    }

    public static function getTimerState(int $scoreId): array
    {
        return self::normalizeTimerState(
            Cache::get(self::timerCacheKey($scoreId), self::defaultTimerState())
        );
    }

    public static function putTimerState(int $scoreId, array $timerState): array
    {
        $normalized = self::normalizeTimerState($timerState);

        Cache::forever(self::timerCacheKey($scoreId), $normalized);

        return $normalized;
    }

    public static function buildPayload(TeamMatchScore $match, ?array $timerState = null): array
    {
        return array_merge(
            $match->toArray(),
            $timerState ?? self::getTimerState($match->id)
        );
    }

    private static function normalizeTimerState(array $timerState): array
    {
        return [
            'main_timer_seconds' => (int) ($timerState['main_timer_seconds'] ?? 1200),
            'raid_timer_seconds' => (int) ($timerState['raid_timer_seconds'] ?? 30),
            'active_side' => $timerState['active_side'] ?? 'none',
            'main_running' => (bool) ($timerState['main_running'] ?? false),
            'raid_running' => (bool) ($timerState['raid_running'] ?? false),
            'synced_at_ms' => (int) ($timerState['synced_at_ms'] ?? round(microtime(true) * 1000)),
        ];
    }
}
