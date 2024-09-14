<?php

namespace App\Mod\Application\Controller;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Application\UseCase\CreateModUseCase;
use App\Mod\Application\UseCase\DeleteModUseCase;
use App\Mod\Application\UseCase\GetAllModUseCase;
use App\Mod\Application\UseCase\GetModUseCase;
use App\Mod\Application\UseCase\UpdateModUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ModController extends AbstractController
{

    public function __construct(
        private GetModUseCase $getModUseCase,
        private GetAllModUseCase $getAllModUseCase,
        private CreateModUseCase $createModUseCase,
        private DeleteModUseCase $deleteModUseCase,
        private UpdateModUseCase $updateModUseCase
    ) {}

    #[Route('/mods', methods: ['GET'])]
    public function getAllMods()
    {
        $mods = $this->getAllModUseCase->execute();
        return $this->json($mods);
    }

    #[Route('/mod/{modId}', methods: ['GET'])]
    public function getMod($modId)
    {
        if (!$modId) {
            return $this->json(['error' => 'An modId is required'], Response::HTTP_BAD_REQUEST);
        }

        if (!is_numeric($modId)) {
            return $this->json(['error' => 'The modId must be a number'], Response::HTTP_BAD_REQUEST);
        }

        $mod = $this->getModUseCase->execute($modId);
        return $this->json($mod);
    }

    #[Route('/mod', methods: ['POST'])]
    public function createMod(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $modDTO = new ModDTO($data);

        $result = $this->createModUseCase->execute($modDTO);

        if (isset($result['errors'])) {
            return $this->json($result['errors'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($result['mod'], Response::HTTP_CREATED);
    }

    #[Route('/mod/{modId}', methods: ['DELETE'])]
    public function deleteMod(int $modId): Response
    {
        if ($this->deleteModUseCase->execute($modId)) {
            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json(['error' => 'Mod not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/mod/{modId}', methods: ['PUT'])]
    public function updateMod(Request $request, int $modId): Response
    {
        $data = json_decode($request->getContent(), true);

        $modDTO = new ModDTO($data);

        $mod = $this->updateModUseCase->execute($modId, $modDTO);

        if (!$mod) {
            return $this->json(['error' => 'Mod not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($mod);
    }
}
