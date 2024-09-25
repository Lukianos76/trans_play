<?php

namespace App\Application\UseCase\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Application\Exception\BadRequestException;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class UpdateModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModValidatorInterface $validator) {}

    public function execute($modId, ModDTO $modDTO): ?Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            throw new ElementNotFoundException('mod');
        }

        $this->validate($this->validator, $modDTO);

        $mod->setName($modDTO->name ?? $mod->getName());
        $mod->setDescription($modDTO->description ?? $mod->getDescription());
        $mod->setVersion($modDTO->version ?? $mod->getVersion());
        $mod->setUrl($modDTO->url ?? $mod->getUrl());

        $this->modRepository->update($mod, true);

        return $mod;
    }
}
