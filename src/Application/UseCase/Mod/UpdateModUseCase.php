<?php

namespace App\Application\UseCase\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class UpdateModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModValidatorInterface $validator) {}

    public function execute($modId, array $datas): ?Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            throw new ElementNotFoundException('mod');
        }

        $modDTO = new ModDTO($datas);

        $this->validate($this->validator, $modDTO, array_keys($modDTO->toArray()));

        $mod->setName($modDTO->name ?? $mod->getName());
        $mod->setDescription($modDTO->description ?? $mod->getDescription());
        $mod->setVersion($modDTO->version ?? $mod->getVersion());
        $mod->setUrl($modDTO->url ?? $mod->getUrl());
        $mod->setGame($modDTO->game ?? $mod->getGame());

        $this->modRepository->update($mod, true);

        return $mod;
    }
}
