<?php

namespace App\{{entityName}}\Application\Controller;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Application\UseCase\Create{{entityName}}UseCase;
use App\{{entityName}}\Application\UseCase\Delete{{entityName}}UseCase;
use App\{{entityName}}\Application\UseCase\GetAll{{entityName}}UseCase;
use App\{{entityName}}\Application\UseCase\Get{{entityName}}UseCase;
use App\{{entityName}}\Application\UseCase\Update{{entityName}}UseCase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class {{entityName}}Controller extends AbstractController
{

    public function __construct(
        private Get{{entityName}}UseCase $get{{entityName}}UseCase,
        private GetAll{{entityName}}UseCase $getAll{{entityName}}UseCase,
        private Create{{entityName}}UseCase $create{{entityName}}UseCase,
        private Delete{{entityName}}UseCase $delete{{entityName}}UseCase,
        private Update{{entityName}}UseCase $update{{entityName}}UseCase
    ) {}

    #[Route('/{{entityNameLower}}s', methods: ['GET'])]
    public function getAll{{entityName}}s()
    {
        ${{entityNameLower}}s = $this->getAll{{entityName}}UseCase->execute();
        return $this->json(${{entityNameLower}}s);
    }

    #[Route('/{{entityNameLower}}/{id}', methods: ['GET'])]
    public function get{{entityName}}($id)
    {
        if (!$id) {
            return $this->json(['error' => 'An id is required'], Response::HTTP_BAD_REQUEST);
        }

        if (!is_numeric($id)) {
            return $this->json(['error' => 'The id must be a number'], Response::HTTP_BAD_REQUEST);
        }

        ${{entityNameLower}} = $this->get{{entityName}}UseCase->execute($id);
        return $this->json(${{entityNameLower}});
    }

    #[Route('/{{entityNameLower}}', methods: ['POST'])]
    public function create{{entityName}}(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        ${{entityNameLower}}DTO = new {{entityName}}DTO($data);

        $result = $this->create{{entityName}}UseCase->execute(${{entityNameLower}}DTO);

        if (isset($result['errors'])) {
            return $this->json($result['errors'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($result['{{entityNameLower}}'], Response::HTTP_CREATED);
    }

    #[Route('/{{entityNameLower}}/{id}', methods: ['DELETE'])]
    public function delete{{entityName}}(int $id): Response
    {
        if ($this->delete{{entityName}}UseCase->execute($id)) {
            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json(['error' => '{{entityName}} not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/{{entityNameLower}}/{id}', methods: ['PUT'])]
    public function update{{entityName}}(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        ${{entityNameLower}}DTO = new {{entityName}}DTO($data);

        ${{entityNameLower}} = $this->update{{entityName}}UseCase->execute($id, ${{entityNameLower}}DTO);

        if (!${{entityNameLower}}) {
            return $this->json(['error' => '{{entityName}} not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(${{entityNameLower}});
    }
}
