<?php

namespace Tests\Unit\Game\Application\UseCases\Requests;

use Tests\TestCase;
use Game\Application\UseCases\Requests\SetPiece;

final class SetPieceTest extends TestCase
{
    private const DUMMY_INT = 1;

    public function dataProvider(): array
    {
        return [
            [[SetPiece::X => self::DUMMY_INT, SetPiece::Y => self::DUMMY_INT, ]],
        ];
    }

    /**
     * @dataProvider dataProvider
     */
    public function testSuccessCreation(array $data)
    {
        $request = new SetPiece($data);
        $this->assertTrue(true);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetX(array $data)
    {
        $request = new SetPiece($data);

        $this->assertEquals($request->getX(), self::DUMMY_INT);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testGetY(array $data)
    {
        $request = new SetPiece($data);

        $this->assertEquals($request->getY(), self::DUMMY_INT);
    }
}
