<?php

namespace App\Application\UseCase\Game;

use App\Application\DTO\Game\GameDTO;
use App\Domain\Entity\Game\Game;
use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Domain\Validator\Game\GameValidatorInterface;
use App\Application\UseCase\UseCase;

final class CreateGameUseCase extends UseCase
{
    public function __construct(private GameRepositoryInterface $gameRepository, private GameValidatorInterface $validator) {}

    public function execute(GameDTO $gameDTO): Game
    {
        $this->validate($this->validator, $gameDTO);

        $game = new Game($gameDTO->toArray());
        $this->gameRepository->create($game, true);

        return $game;
    }
}
