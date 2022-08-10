<?php

namespace Game\Presentation\Requests;

use App\Http\Request;
use Game\Application\UseCases\Requests\SetPiece as CaseRequest;
use Game\Domain\Game\GameMap;

final class SetPiece extends Request
{
    public function rules(): array
    {
        $maxValue = GameMap::BOARD_SIZE - 1;

        return [
            CaseRequest::X => sprintf('required|integer|min:0|max:%s', $maxValue),
            CaseRequest::Y => sprintf('required|integer|min:0|max:%s', $maxValue),
        ];
    }
}
