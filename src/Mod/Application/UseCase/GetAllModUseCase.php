<?php

namespace App\Mod\Application\UseCase;

use App\Mod\Domain\Repository\ModRepositoryInterface;

final class GetAllModUseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute(): array
    {
        $mods = $this->modRepository->getAll();

        return $mods;
    }
}
