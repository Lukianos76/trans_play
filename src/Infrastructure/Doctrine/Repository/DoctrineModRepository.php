<?php

namespace App\Infrastructure\Doctrine\Repository;

use App\Domain\Entity\Mod;
use App\Domain\Repository\ModRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DoctrineModRepository extends ServiceEntityRepository implements ModRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mod::class);
    }

    public function save(Mod $mod): void
    {
        $this->add($mod, true);
    }

    public function create(Mod $mod, bool $flush = false): Mod
    {
        $this->getEntityManager()->persist($mod);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $mod;
    }

    public function delete(Mod $mod, bool $flush = false): void
    {
        $this->getEntityManager()->remove($mod);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getOneById(int $id): ?Mod
    {
        return $this->find($id);
    }

    public function getAll(): array
    {
        return $this->findAll();
    }
}
