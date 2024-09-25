<?php

namespace App\Application\UseCase\Game;

use App\Application\Exception\BadRequestException;
use App\Domain\Entity\Game\Game;
use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Application\UseCase\UseCase;

final class GetGameUseCase extends UseCase
{
    public function __construct(private GameRepositoryInterface $gameRepository) {}

    public function execute($gameId): Game
    {
        $game = $this->gameRepository->getOneById($gameId);

        return $game;
    }
}
