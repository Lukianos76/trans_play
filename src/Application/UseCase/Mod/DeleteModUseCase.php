<?php

namespace App\Application\UseCase\Mod;

use App\Application\Exception\BadRequestException;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;

final class DeleteModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute($modId): bool
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            throw new ElementNotFoundException('mod');
        }

        return $this->modRepository->delete($modId, true);
    }
}
