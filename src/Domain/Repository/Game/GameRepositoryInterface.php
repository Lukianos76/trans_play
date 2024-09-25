<?php

namespace App\Domain\Repository\Game;

interface GameRepositoryInterface
{
    public function create($game, bool $flush = false);
    public function delete(int $id, bool $flush = false): bool;
    public function update($game, bool $flush = false);
    public function getAll(): array;
    public function getOneById(int $id);
}
