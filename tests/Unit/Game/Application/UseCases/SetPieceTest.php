<?php

namespace Tests\Unit\Game\Application\UseCases;

use App\Adapters\DataBase\Contracts\DataBase;
use App\Exceptions\Custom\ResourceNotFoundException;
use Tests\TestCase;
use Tests\Unit\MockBuilder;
use Game\Application\UseCases\SetPiece as UseCase;
use Game\Application\UseCases\Requests\SetPiece as Request;
use Game\Application\UseCases\Responses\SetPiece as Response;
use Game\Domain\Game\Game as Model;
use Game\Domain\Game\Repositories\GameRepository as Repository;
use Game\Domain\Game\Services\Validation\Contracts\ValidationChainHandler as Validator;
use Game\Domain\Game\Services\GameRules\Contracts\BoardHandler;
use Game\Domain\Game\Structures\Coordinate;

final class SetPieceTest extends TestCase
{
    use MockBuilder;

    private const DUMMY_ARRAY = [];
    private const DUMMY_INT = 1;

    private DataBase $db;
    private Repository $repository;
    private Validator $validator;
    private BoardHandler $boardHandler;
    private UseCase $case;

    protected function setUp(): void
    {
        $this->createApplication();
        $this->db = $this->getMock(DataBase::class);
        $this->repository = $this->getMock(Repository::class);
        $this->validator = $this->getMock(Validator::class);
        $this->boardHandler = $this->getMock(BoardHandler::class);
        $this->case = new UseCase(
            $this->db,
            $this->repository,
            $this->validator,
            $this->boardHandler
        );
    }

    /**
     * @dataProvider requestProvider
     */
    public function testErrorException(string $piece, Request $request)
    {
        $game = $this->getMock(Model::class);
        $game->expects($this->once())
            ->method('getBoard')
            ->will($this->throwException(new \Exception()));

        $this->repository->method('findSingle')->willReturn($game);
        $this->validator->expects($this->once())->method('handle');

        $this->db->method('beginTransaction');
        $this->db->method('rollBack');

        $this->expectException(\Exception::class);

        $actualResult = $this->case->execute($piece, $request);
    }

    /**
     * @dataProvider requestProvider
     */
    public function testSuccess(string $piece, Request $request)
    {
        $game = $this->getMock(Model::class);
        $game->method('getBoard')->willReturn(self::DUMMY_ARRAY);

        $this->repository->method('findSingle')->willReturn($game);
        $this->repository->method('update')->willReturn($game);

        $this->boardHandler->method('getWinnerOrNull')->willReturn(Model::FIRST_PLAYER_SIGN);

        $this->validator->expects($this->once())->method('handle');

        $this->db->method('beginTransaction');
        $this->db->method('commit');

        $expectedResult = new Response($game);
        $actualResult = $this->case->execute($piece, $request);

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function requestProvider(): array
    {
        $data = [
            Request::X => self::DUMMY_INT,
            Request::Y => self::DUMMY_INT,
        ];

        return [
            [
                Model::FIRST_PLAYER_SIGN,
                new Request($data),
            ],
        ];
    }
}
