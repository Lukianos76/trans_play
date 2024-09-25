<?php

namespace App\Application\UseCase\Mod;

use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Application\UseCase\UseCase;

final class GetAllModUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute(): array
    {
        $mods = $this->modRepository->getAll();

        return $mods;
    }
}
