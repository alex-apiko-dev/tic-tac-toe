<?php

namespace Tests\Unit\Game\Application\UseCases\Responses;

use Tests\TestCase;
use Game\Application\UseCases\Responses\Restart;

final class RestartTest extends TestCase
{
    private const DUMMY = 'dummy';

    public function testSuccessCreation()
    {
        $response = new Restart(self::DUMMY);
        $this->assertTrue(true);
    }

    public function testGetGame()
    {
        $response = new Restart(self::DUMMY);

        $this->assertEquals(self::DUMMY, $response->getGame());
    }
}
