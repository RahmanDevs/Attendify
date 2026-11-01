<?php

namespace App\Libraries;

class BiometricService
{
    /**
     * Threshold for Face-API.js Euclidean distance.
     * Values below 0.6 indicate the same person. Lower is stricter.
     */
    public const DEFAULT_THRESHOLD = 0.55;

    /**
     * Calculate Euclidean distance between two 128-dimensional float arrays
     *
     * @param array $vec1
     * @param array $vec2
     * @return float
     */
    public static function euclideanDistance(array $vec1, array $vec2): float
    {
        if (count($vec1) !== count($vec2) || empty($vec1)) {
            return 999.0;
        }

        $sum = 0.0;
        $count = count($vec1);
        for ($i = 0; $i < $count; $i++) {
            $diff = (float)$vec1[$i] - (float)$vec2[$i];
            $sum += $diff * $diff;
        }

        return sqrt($sum);
    }

    /**
     * Verify if two face descriptors match and return match score
     *
     * @param array|string $descriptorInput (JSON or Array)
     * @param array|string $descriptorStored (JSON or Array)
     * @param float $threshold
     * @return array [is_match => bool, distance => float, match_score => float]
     */
    public static function verifyFace($descriptorInput, $descriptorStored, float $threshold = self::DEFAULT_THRESHOLD): array
    {
        if (is_string($descriptorInput)) {
            $descriptorInput = json_decode($descriptorInput, true) ?? [];
        }
        if (is_string($descriptorStored)) {
            $descriptorStored = json_decode($descriptorStored, true) ?? [];
        }

        if (empty($descriptorInput) || empty($descriptorStored)) {
            return [
                'is_match'    => false,
                'distance'    => 999.0,
                'match_score' => 0.0,
                'message'     => 'Format deskriptor biometrik wajah tidak valid',
            ];
        }

        $distance = self::euclideanDistance($descriptorInput, $descriptorStored);
        $isMatch = ($distance <= $threshold);

        // Convert distance to percentage score (0 distance = 100%, 0.6 distance = 70%, 1.0+ distance = 0%)
        $score = max(0.0, min(100.0, round((1.0 - ($distance / 1.2)) * 100, 2)));

        return [
            'is_match'    => $isMatch,
            'distance'    => round($distance, 4),
            'match_score' => $score,
            'message'     => $isMatch ? 'Verifikasi biometrik wajah berhasil' : 'Wajah tidak cocok dengan data biometrik terdaftar',
        ];
    }
}
