<?php

namespace App\Domain\Repository\Mod;

interface ModFileRepositoryInterface
{
    public function create($mod, bool $flush = false);
    public function delete(int $id, bool $flush = false): bool;
    public function getOneById(int $id);
}
