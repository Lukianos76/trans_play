<?php

namespace App\Infrastructure\Doctrine\Repository\Mod;

use App\Domain\Entity\Mod\ModFile;
use App\Domain\Repository\Mod\ModFileRepositoryInterface;
use App\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineModFileRepository extends DoctrineRepository implements ModFileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ModFile::class);
    }
}
