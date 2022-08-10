<?php

namespace Tests\Unit\Game\Application\UseCases\Responses;

use Tests\TestCase;
use Game\Application\UseCases\Responses\Clear;

final class ClearTest extends TestCase
{
    private const DUMMY = 'dummy';

    public function testSuccessCreation()
    {
        $response = new Clear(self::DUMMY);
        $this->assertTrue(true);
    }

    public function testGetGame()
    {
        $response = new Clear(self::DUMMY);

        $this->assertEquals(self::DUMMY, $response->getGame());
    }
}
