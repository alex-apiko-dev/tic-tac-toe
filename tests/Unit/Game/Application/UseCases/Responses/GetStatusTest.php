<?php

namespace Tests\Unit\Game\Application\UseCases\Responses;

use Tests\TestCase;
use Game\Application\UseCases\Responses\GetStatus;

final class GetStatusTest extends TestCase
{
    private const DUMMY = 'dummy';

    public function testSuccessCreation()
    {
        $response = new GetStatus(self::DUMMY);
        $this->assertTrue(true);
    }

    public function testGetGame()
    {
        $response = new GetStatus(self::DUMMY);

        $this->assertEquals(self::DUMMY, $response->getGame());
    }
}
