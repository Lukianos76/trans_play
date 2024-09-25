<?php

namespace App\Application\UseCase\Game;

use App\Application\DTO\Game\GameDTO;
use App\Domain\Entity\Game\Game;
use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Domain\Validator\Game\GameValidatorInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class UpdateGameUseCase extends UseCase
{
    public function __construct(private GameRepositoryInterface $gameRepository, private GameValidatorInterface $validator) {}

    public function execute($gameId, GameDTO $gameDTO): ?Game
    {
        $game = $this->gameRepository->getOneById($gameId);

        if (!$game) {
            throw new ElementNotFoundException('game');
        }

        $this->validate($this->validator, $gameDTO, array_keys($gameDTO->toArray()));

        $game->setName($gameDTO->name ?? $game->getName());

        $this->gameRepository->update($game, true);

        return $game;
    }
}
