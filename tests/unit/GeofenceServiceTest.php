<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Libraries\GeofenceService;

/**
 * @internal
 */
final class GeofenceServiceTest extends CIUnitTestCase
{
    public function testZeroDistanceForSameCoordinates(): void
    {
        $lat = -6.225014;
        $lon = 106.809656;

        $distance = GeofenceService::calculateDistance($lat, $lon, $lat, $lon);
        $this->assertEquals(0.0, $distance);
    }

    public function testValidateLocationInsideRadius(): void
    {
        $officeLat = -6.225014;
        $officeLon = 106.809656;

        // Very close point (~10 meters away)
        $userLat = -6.225090;
        $userLon = 106.809656;

        $result = GeofenceService::validateLocation($userLat, $userLon, $officeLat, $officeLon, 150);
        $this->assertTrue($result['is_valid']);
        $this->assertLessThanOrEqual(150, $result['distance']);
    }

    public function testValidateLocationOutsideRadius(): void
    {
        $officeLat = -6.225014;
        $officeLon = 106.809656;

        // Far point (Bandung coordinate ~115 km away)
        $userLat = -6.917464;
        $userLon = 107.619123;

        $result = GeofenceService::validateLocation($userLat, $userLon, $officeLat, $officeLon, 100);
        $this->assertFalse($result['is_valid']);
        $this->assertGreaterThan(1000, $result['distance']);
    }
}
