<?php

namespace App\Infrastructure\Doctrine\Repository\Mod;

use App\Domain\Entity\Mod\Mod;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineModRepository extends DoctrineRepository implements ModRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mod::class);
    }
}
