<?php

namespace App\Mod\Application\Controller;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Application\Handler\CreateModHandler;
use App\Mod\Application\Handler\DeleteModHandler;
use App\Mod\Application\Handler\GetAllModHandler;
use App\Mod\Application\Handler\GetModHandler;
use App\Mod\Application\Handler\UpdateModHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class ModController extends AbstractController
{

    public function __construct(
        private GetModHandler $getModHandler,
        private GetAllModHandler $getAllModHandler,
        private CreateModHandler $createModHandler,
        private DeleteModHandler $deleteModHandler,
        private UpdateModHandler $updateModHandler
    ) {}

    #[Route('/mods', methods: ['GET'])]
    public function getAllMods()
    {
        $mods = $this->getAllModHandler->handle();
        return $this->json($mods);
    }

    #[Route('/mod/{id}', methods: ['GET'])]
    public function getMod($id)
    {
        if (!$id) {
            return $this->json(['error' => 'An id is required'], Response::HTTP_BAD_REQUEST);
        }

        if (!is_numeric($id)) {
            return $this->json(['error' => 'The id must be a number'], Response::HTTP_BAD_REQUEST);
        }

        $mod = $this->getModHandler->handle($id);
        return $this->json($mod);
    }

    #[Route('/mod', methods: ['POST'])]
    public function createMod(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $modDTO = new ModDTO($data);

        $result = $this->createModHandler->handle($modDTO);

        if (isset($result['errors'])) {
            return $this->json($result['errors'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($result['mod'], Response::HTTP_CREATED);
    }

    #[Route('/mod/{id}', methods: ['DELETE'])]
    public function deleteMod(int $id): Response
    {
        if ($this->deleteModHandler->handle($id)) {
            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json(['error' => 'Mod not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/mod/{id}', methods: ['PUT'])]
    public function updateMod(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        $modDTO = new ModDTO($data);

        $mod = $this->updateModHandler->handle($id, $modDTO);

        if (!$mod) {
            return $this->json(['error' => 'Mod not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json($mod);
    }
}
