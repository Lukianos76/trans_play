<?php

namespace App\Mod\Infrastructure\Doctrine\Repository;

use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;
use App\Shared\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineModRepository extends DoctrineRepository implements ModRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mod::class);
    }
}
