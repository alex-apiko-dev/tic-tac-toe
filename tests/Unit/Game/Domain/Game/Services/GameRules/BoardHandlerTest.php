<?php

namespace Tests\Unit\Game\Domain\Game\Services\GameRules;

use Tests\TestCase;
use Tests\Unit\MockBuilder;
use Game\Domain\Game\Game as Model;
use Game\Domain\Game\Services\GameRules\BoardHandler as Service;
use Game\Domain\Game\Services\GameRules\LineChecker\Contracts\LineCheckerBuilder;
use Game\Domain\Game\Services\GameRules\LineChecker\CheckerTypes\{
    DiagonalTLBRChecker,
    DiagonalTRBLChecker,
    HorizontalChecker,
    VerticalChecker
};

final class BoardHandlerTest extends TestCase
{
    use MockBuilder;

    private LineCheckerBuilder $checkerBuilder;
    private Service $service;

    protected function setUp(): void
    {
        $this->createApplication();
        $this->checkerBuilder = $this->getMock(LineCheckerBuilder::class);
        $this->service = new Service(
            $this->checkerBuilder
        );
    }

    /**
     * @dataProvider dataDrawProvider
     */
    public function testSuccessDraw(array $board)
    {
        $game = $this->getMock(Model::class);
        $game->method('getBoard')->willReturn($board);

        $actualResult = $this->service->getWinnerOrNull($game);

        $this->assertEquals(Model::FINISHED, $actualResult);
    }

    /**
     * @dataProvider dataProvider
     */
    public function testSuccess(array $board)
    {
        $game = $this->getMock(Model::class);
        $game->method('getBoard')->willReturn($board);

        $this->checkerBuilder
            ->method('getHorizontalLineChecker')
            ->willReturn(new HorizontalChecker());

        $this->checkerBuilder
            ->method('getVerticalLineChecker')
            ->willReturn(new VerticalChecker());

        $this->checkerBuilder
            ->method('getDiagonalTLBRLineChecker')
            ->willReturn(new DiagonalTLBRChecker());

        $this->checkerBuilder
            ->method('getDiagonalTRBLLineChecker')
            ->willReturn(new DiagonalTRBLChecker());

        $actualResult = $this->service->getWinnerOrNull($game);

        $this->assertEquals(Model::FIRST_PLAYER_SIGN, $actualResult);
    }

    public function dataProvider(): array
    {
        $boardHorizontal = [
            [Model::FIRST_PLAYER_SIGN, Model::FIRST_PLAYER_SIGN, Model::FIRST_PLAYER_SIGN, ],
            ['', '', '', ],
            ['', '', '', ],
        ];

        $boardVertical = [
            [Model::FIRST_PLAYER_SIGN, '', '', ],
            [Model::FIRST_PLAYER_SIGN, '', '', ],
            [Model::FIRST_PLAYER_SIGN, '', '', ],
        ];

        $boardDiagonalTLBR = [
            [Model::FIRST_PLAYER_SIGN, '', '', ],
            ['', Model::FIRST_PLAYER_SIGN, '', ],
            ['', '', Model::FIRST_PLAYER_SIGN, ],
        ];

        $boardDiagonalTRBL = [
            ['', '', Model::FIRST_PLAYER_SIGN, ],
            ['', Model::FIRST_PLAYER_SIGN, '', ],
            [Model::FIRST_PLAYER_SIGN, '', '', ],
        ];

        return [
            [$boardHorizontal, ],
            [$boardVertical, ],
            [$boardDiagonalTLBR, ],
            [$boardDiagonalTRBL, ],
        ];
    }

    public function dataDrawProvider(): array
    {
        $draw = [
            [Model::FIRST_PLAYER_SIGN, Model::SECOND_PLAYER_SIGN, Model::FIRST_PLAYER_SIGN, ],
            [Model::SECOND_PLAYER_SIGN, Model::FIRST_PLAYER_SIGN, Model::SECOND_PLAYER_SIGN, ],
            [Model::FIRST_PLAYER_SIGN, Model::SECOND_PLAYER_SIGN, Model::FIRST_PLAYER_SIGN, ],
        ];

        return [
            [$draw, ],
        ];
    }
}
