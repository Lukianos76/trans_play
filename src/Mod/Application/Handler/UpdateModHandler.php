<?php

namespace App\Mod\Application\Handler;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;

final class UpdateModHandler
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function handle(int $modId, ModDTO $modDto): ?Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            return null;
        }

        $mod->setName($modDto->name ?? $mod->getName());
        $mod->setDescription($modDto->description ?? $mod->getDescription());
        $mod->setVersion($modDto->version ?? $mod->getVersion());
        $mod->setUrl($modDto->url ?? $mod->getUrl());

        $this->modRepository->update($mod, true);

        return $mod;
    }
}
