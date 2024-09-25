<?php

namespace App\Application\UseCase\Mod;

use App\Application\Exception\BadRequestException;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Application\UseCase\UseCase;

final class GetModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute($modId): Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        return $mod;
    }
}
