<?php

namespace App\Application\UseCase\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Application\UseCase\UseCase;

final class CreateModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModValidatorInterface $validator) {}

    public function execute(ModDTO $modDTO): array
    {
        $this->validate($this->validator, $modDTO);

        $mod = new Mod($modDTO->toArray());
        $this->modRepository->create($mod, true);

        return ['mod' => $mod];
    }
}
