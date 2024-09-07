<?php

namespace App\Application\Controller;

use App\Domain\Entity\Mod;
use App\Domain\Repository\ModRepositoryInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

class ModController extends AbstractController
{
    #[
        Route('/mods', methods: ['GET'])
    ]
    public function getAllMods(ModRepositoryInterface $modRepository)
    {
        $mods = $modRepository->getAll();

        return $this->json($mods);
    }
}
