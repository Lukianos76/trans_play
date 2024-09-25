<?php

namespace App\Domain\Repository\File;

interface FileRepositoryInterface
{
    public function create($mod, bool $flush = false);
    public function delete(int $id, bool $flush = false): bool;
}
