<?php

namespace App\Libraries;

class GeofenceService
{
    /**
     * Calculate distance between two coordinates in meters using the Haversine formula
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float Distance in meters
     */
    public static function calculateDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $earthRadius = 6371000; // in meters

        $latDelta = deg2rad($lat2 - $lat1);
        $lonDelta = deg2rad($lon2 - $lon1);

        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
             sin($lonDelta / 2) * sin($lonDelta / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return round($earthRadius * $c, 2);
    }

    /**
     * Check if a coordinate is within the allowed radius of an office location
     *
     * @param float $userLat
     * @param float $userLon
     * @param float $officeLat
     * @param float $officeLon
     * @param int   $allowedRadiusMeters
     * @return array [is_valid => bool, distance => float, message => string]
     */
    public static function validateLocation(
        float $userLat,
        float $userLon,
        float $officeLat,
        float $officeLon,
        int $allowedRadiusMeters = 100
    ): array {
        $distance = self::calculateDistance($userLat, $userLon, $officeLat, $officeLon);
        $isValid = ($distance <= $allowedRadiusMeters);

        return [
            'is_valid' => $isValid,
            'distance' => $distance,
            'allowed_radius' => $allowedRadiusMeters,
            'message'  => $isValid
                ? "Lokasi valid ({$distance} m dari kantor)"
                : "Lokasi di luar radius izin presensi ({$distance} m dari radius maks {$allowedRadiusMeters} m)",
        ];
    }
}
