<?php

namespace App\Infrastructure\Doctrine\Repository\File;

use App\Domain\Entity\File\File;
use App\Domain\Repository\File\FileRepositoryInterface;
use App\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineFileRepository extends DoctrineRepository implements FileRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, File::class);
    }
}
