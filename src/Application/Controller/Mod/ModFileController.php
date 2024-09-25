<?php

namespace App\Application\Controller\Mod;

use App\Application\UseCase\Mod\DeleteModFilesUseCase;
use App\Application\Exception\ElementNotFoundException;
use App\Application\UseCase\Mod\UploadModFilesUseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class ModFileController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private UploadModFilesUseCase $uploadModFilesUseCase,
        private DeleteModFilesUseCase $deleteModFilesUseCase
    ) {}

    #[Route('/mod/{modId}/upload', methods: ['POST'])]
    public function addModFile(Request $request, $modId): Response
    {
        $files = $request->files->get('files');

        try {
            $mod = $this->uploadModFilesUseCase->execute($modId, $files);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }

        return $this->json($mod, Response::HTTP_OK, [], ['groups' => ['mod']]);
    }

    #[Route('/mod/{modId}/removeFile/{modFileId}', methods: ['DELETE'])]
    public function deleteModFile($modId, $modFileId): Response
    {
        try {
            $this->deleteModFilesUseCase->execute($modId, $modFileId);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }


        return $this->json([], Response::HTTP_NO_CONTENT);
    }
}
