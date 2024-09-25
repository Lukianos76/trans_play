<?php

namespace App\Application\Controller\Mod;

use App\Application\Exception\ElementNotFoundException;
use App\Application\Exception\ValidationException;
use App\Application\DTO\Mod\ModDTO;
use App\Application\UseCase\Mod\CreateModUseCase;
use App\Application\UseCase\Mod\DeleteModUseCase;
use App\Application\UseCase\Mod\GetAllModUseCase;
use App\Application\UseCase\Mod\GetModUseCase;
use App\Application\UseCase\Mod\UpdateModUseCase;
use App\Application\Exception\InvalidIdException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ModController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private GetModUseCase $getModUseCase,
        private GetAllModUseCase $getAllModUseCase,
        private CreateModUseCase $createModUseCase,
        private DeleteModUseCase $deleteModUseCase,
        private UpdateModUseCase $updateModUseCase,
    ) {}

    #[Route('/mods', methods: ['GET'])]
    public function getAllMods()
    {
        $mods = $this->getAllModUseCase->execute();
        return $this->json($mods, Response::HTTP_OK, [], ['groups' => ['mod']]);
    }

    #[Route('/mod/{modId}', methods: ['GET'])]
    public function getMod($modId)
    {
        if (!$modId) {
            throw new InvalidIdException('mod');
        }

        if (!is_numeric($modId)) {
            throw new InvalidIdException('mod');
        }

        $mod = $this->getModUseCase->execute($modId);
        return $this->json($mod, Response::HTTP_OK, [], ['groups' => ['mod']]);
    }

    #[Route('/mod', methods: ['POST'])]
    public function createMod(Request $request): Response
    {
        $datas = json_decode($request->getContent(), true);

        try {
            $mod = $this->createModUseCase->execute($datas);
        } catch (ValidationException $e) {
            throw $e;
        }

        return $this->json($mod, Response::HTTP_CREATED, [], ['groups' => ['mod']]);
    }

    #[Route('/mod/{modId}', methods: ['DELETE'])]
    public function deleteMod($modId): Response
    {
        try {
            $this->deleteModUseCase->execute($modId);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }


        return $this->json([], Response::HTTP_NO_CONTENT);
    }

    #[Route('/mod/{modId}', methods: ['PUT'])]
    public function updateMod(Request $request, $modId): Response
    {
        $datas = json_decode($request->getContent(), true);

        try {
            $mod = $this->updateModUseCase->execute($modId, $datas);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }

        return $this->json($mod, Response::HTTP_OK, [], ['groups' => ['mod']]);
    }
}
