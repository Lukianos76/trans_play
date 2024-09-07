<?php

namespace App\Domain\Repository;

use App\Domain\Entity\Mod;

interface ModRepositoryInterface
{
    public function create(Mod $mod, bool $flush = false): Mod;
    public function delete(Mod $mod, bool $flush = false): void;
    public function getAll(): array;
    public function getOneById(int $id): ?Mod;
}
