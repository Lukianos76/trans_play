<?php

namespace App\{{entityName}}\Infrastructure\Doctrine\Repository;

use App\{{entityName}}\Domain\Entity\{{entityName}};
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;
use App\Shared\Infrastructure\Doctrine\Repository\DoctrineRepository;
use Doctrine\Persistence\ManagerRegistry;

class Doctrine{{entityName}}Repository extends DoctrineRepository implements {{entityName}}RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, {{entityName}}::class);
    }
}
