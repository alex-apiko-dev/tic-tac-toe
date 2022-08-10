<?php

namespace Tests\Unit\Game\Application\UseCases;

use App\Adapters\DataBase\Contracts\DataBase;
use App\Exceptions\Custom\ResourceNotFoundException;
use Tests\TestCase;
use Tests\Unit\MockBuilder;
use Game\Application\UseCases\Clear as UseCase;
use Game\Application\UseCases\Responses\Clear as Response;
use Game\Domain\Game\Game as Model;
use Game\Domain\Game\Repositories\GameRepository as Repository;

final class ClearTest extends TestCase
{
    use MockBuilder;

    private DataBase $db;
    private Repository $repository;
    private UseCase $case;

    protected function setUp(): void
    {
        $this->createApplication();
        $this->db = $this->getMock(DataBase::class);
        $this->repository = $this->getMock(Repository::class);
        $this->case = new UseCase(
            $this->db,
            $this->repository
        );
    }

    public function testRepositoryException()
    {
        $this->repository
            ->expects($this->once())
            ->method('findSingle')
            ->will($this->throwException(new ResourceNotFoundException()));

        $this->expectException(ResourceNotFoundException::class);

        $actualResult = $this->case->execute();
    }

    public function testErrorException()
    {
        $game = $this->getMock(Model::class);
        $this->repository->method('findSingle')->willReturn($game);
        $this->repository
            ->expects($this->once())
            ->method('resetVictory')
            ->will($this->throwException(new \Exception()));

        $this->db->method('beginTransaction');
        $this->db->method('rollBack');

        $this->expectException(\Exception::class);

        $actualResult = $this->case->execute();
    }

    public function testSuccess()
    {
        $game = $this->getMock(Model::class);
        $this->repository->method('findSingle')->willReturn($game);
        $this->repository->method('resetVictory')->willReturn($game);
        $this->repository->method('resetScore')->willReturn($game);
        $this->repository->method('resetBoard')->willReturn($game);

        $this->db->method('beginTransaction');
        $this->db->method('commit');

        $expectedResult = new Response($game);
        $actualResult = $this->case->execute();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
