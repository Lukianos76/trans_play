<?php

namespace App\Infrastructure\Doctrine\Repository\Game;

use App\Domain\Entity\Game\Game;
use App\Domain\Repository\Game\GameRepositoryInterface;
use App\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineGameRepository extends DoctrineRepository implements GameRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }
}
