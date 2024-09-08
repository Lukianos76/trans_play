<?php

namespace App\Mod\Application\Handler;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Domain\Repository\ModRepositoryInterface;

final class DeleteModHandler
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function handle(int $modId): bool
    {
        return $this->modRepository->delete($modId, true);
    }
}
