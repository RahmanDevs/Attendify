<?php

namespace Tests\Unit;

use CodeIgniter\Test\CIUnitTestCase;
use App\Libraries\BiometricService;

/**
 * @internal
 */
final class BiometricServiceTest extends CIUnitTestCase
{
    public function testEuclideanDistanceIdenticalVectors(): void
    {
        $vec = array_fill(0, 128, 0.5);
        $distance = BiometricService::euclideanDistance($vec, $vec);

        $this->assertEquals(0.0, $distance);
    }

    public function testVerifyFaceMatch(): void
    {
        $vec1 = array_fill(0, 128, 0.1);
        $vec2 = array_fill(0, 128, 0.11); // very close

        $result = BiometricService::verifyFace($vec1, $vec2);
        $this->assertTrue($result['is_match']);
        $this->assertGreaterThan(80.0, $result['match_score']);
    }

    public function testVerifyFaceMismatch(): void
    {
        $vec1 = array_fill(0, 128, 0.0);
        $vec2 = array_fill(0, 128, 1.0); // very far

        $result = BiometricService::verifyFace($vec1, $vec2);
        $this->assertFalse($result['is_match']);
    }

    public function testVerifyFaceWithJsonString(): void
    {
        $vec1 = json_encode(array_fill(0, 128, 0.25));
        $vec2 = json_encode(array_fill(0, 128, 0.25));

        $result = BiometricService::verifyFace($vec1, $vec2);
        $this->assertTrue($result['is_match']);
        $this->assertEquals(100.0, $result['match_score']);
    }
}
