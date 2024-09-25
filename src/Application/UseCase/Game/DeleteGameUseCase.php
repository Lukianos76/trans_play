<?php

namespace App\Application\UseCase\Game;

use App\Application\Exception\BadRequestException;
use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class DeleteGameUseCase extends UseCase
{
    public function __construct(private GameRepositoryInterface $gameRepository) {}

    public function execute($gameId): bool
    {
        $game = $this->gameRepository->getOneById($gameId);

        if (!$game) {
            throw new ElementNotFoundException('game');
        }

        return $this->gameRepository->delete($gameId, true);
    }
}
