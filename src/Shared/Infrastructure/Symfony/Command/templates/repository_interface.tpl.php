<?php

namespace App\{{entityName}}\Domain\Repository;

interface {{entityName}}RepositoryInterface
{
    public function create(${{entityNameLower}}, bool $flush = false);
    public function delete(int $id, bool $flush = false): bool;
    public function update(${{entityNameLower}}, bool $flush = false);
    public function getAll(): array;
    public function getOneById(int $id);
}
