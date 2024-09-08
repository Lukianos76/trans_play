<?php

namespace App\Mod\Application\Handler;

use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;

final class GetModHandler
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function handle(int $modId): Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        return $mod;
    }
}
