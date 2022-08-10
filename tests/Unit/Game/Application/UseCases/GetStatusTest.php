<?php

namespace Tests\Unit\Game\Application\UseCases;

use Tests\TestCase;
use Tests\Unit\MockBuilder;
use Game\Application\UseCases\GetStatus as UseCase;
use Game\Application\UseCases\Responses\GetStatus as Response;
use Game\Domain\Game\Game as Model;
use Game\Domain\Game\Repositories\GameRepository as Repository;

final class GetStatusTest extends TestCase
{
    use MockBuilder;

    private Repository $repository;
    private UseCase $case;

    protected function setUp(): void
    {
        $this->createApplication();
        $this->repository = $this->getMock(Repository::class);
        $this->case = new UseCase(
            $this->repository
        );
    }

    public function testSuccessFound()
    {
        $game = $this->getMock(Model::class);
        $this->repository->method('findSingle')->willReturn($game);

        $expectedResult = new Response($game);
        $actualResult = $this->case->execute();

        $this->assertEquals($expectedResult, $actualResult);
    }

    public function testSuccessCreated()
    {
        $game = $this->getMock(Model::class);
        $this->repository->method('findSingle')->willReturn(null);
        $this->repository->method('initNewGame')->willReturn($game);

        $expectedResult = new Response($game);
        $actualResult = $this->case->execute();

        $this->assertEquals($expectedResult, $actualResult);
    }
}
