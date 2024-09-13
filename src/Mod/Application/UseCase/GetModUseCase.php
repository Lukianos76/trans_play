<?php

namespace App\Mod\Application\UseCase;

use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;

final class GetModUseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute(int $modId): Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        return $mod;
    }
}
