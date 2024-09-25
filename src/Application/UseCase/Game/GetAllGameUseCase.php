<?php

namespace App\Application\UseCase\Game;

use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Application\UseCase\UseCase;

final class GetAllGameUseCase extends UseCase
{
    public function __construct(private GameRepositoryInterface $gameRepository) {}

    public function execute(): array
    {
        $games = $this->gameRepository->getAll();

        return $games;
    }
}
