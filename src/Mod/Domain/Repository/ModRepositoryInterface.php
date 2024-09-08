<?php

namespace App\Mod\Domain\Repository;

interface ModRepositoryInterface
{
    public function create($mod, bool $flush = false);
    public function delete(int $id, bool $flush = false): bool;
    public function update($mod, bool $flush = false);
    public function getAll(): array;
    public function getOneById(int $id);
}
