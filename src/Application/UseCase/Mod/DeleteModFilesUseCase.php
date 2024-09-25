<?php

namespace App\Application\UseCase\Mod;

use App\Application\Exception\BadRequestException;
use App\Domain\Repository\Mod\ModFileRepositoryInterface;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class DeleteModFilesUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModFileRepositoryInterface $modFileRepository) {}

    public function execute($modId, $modFileId): bool
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            throw new ElementNotFoundException('mod');
        }

        $modFile = $this->modFileRepository->getOneById($modFileId);

        if (!$modFile) {
            throw new ElementNotFoundException('mod file');
        }

        return $this->modFileRepository->delete($modFileId, true);
    }
}
