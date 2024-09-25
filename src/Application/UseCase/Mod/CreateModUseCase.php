<?php

namespace App\Application\UseCase\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Application\Exception\ElementNotFoundException;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Application\UseCase\UseCase;
use App\Domain\Repository\Game\GameRepositoryInterface;

final class CreateModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private GameRepositoryInterface $gameRepository, private ModValidatorInterface $validator) {}

    public function execute(array $datas): Mod
    {
        $modDTO = new ModDTO($datas);

        $this->validate($this->validator, $modDTO);

        $game = $this->gameRepository->getOneById($modDTO->gameId);

        if (!$game) {
            throw new ElementNotFoundException('game');
        }

        $modDTO->game = $game;

        $mod = new Mod($modDTO->toArray());
        $this->modRepository->create($mod, true);

        return $mod;
    }
}
