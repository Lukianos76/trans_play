<?php

namespace App\Mod\Application\UseCase;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Domain\Repository\ModRepositoryInterface;

final class DeleteModUseCase
{
    public function __construct(private ModRepositoryInterface $modRepository) {}

    public function execute(int $modId): bool
    {
        return $this->modRepository->delete($modId, true);
    }
}
