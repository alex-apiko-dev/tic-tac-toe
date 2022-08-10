<?php

namespace Tests\Unit\Game\Application\UseCases\Responses;

use Tests\TestCase;
use Game\Application\UseCases\Responses\SetPiece;

final class SetPieceTest extends TestCase
{
    private const DUMMY = 'dummy';

    public function testSuccessCreation()
    {
        $response = new SetPiece(self::DUMMY);
        $this->assertTrue(true);
    }

    public function testGetGame()
    {
        $response = new SetPiece(self::DUMMY);

        $this->assertEquals(self::DUMMY, $response->getGame());
    }
}
