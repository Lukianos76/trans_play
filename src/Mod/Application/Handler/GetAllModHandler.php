<?php

namespace App\Mod\Application\Handler;

use App\Mod\Domain\Repository\ModRepositoryInterface;

final class GetAllModHandler
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function handle(): array
    {
        $mods = $this->modRepository->getAll();

        return $mods;
    }
}
