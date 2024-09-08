<?php

namespace App\{{entityName}}\Application\Controller;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Application\Handler\Create{{entityName}}Handler;
use App\{{entityName}}\Application\Handler\Delete{{entityName}}Handler;
use App\{{entityName}}\Application\Handler\GetAll{{entityName}}Handler;
use App\{{entityName}}\Application\Handler\Get{{entityName}}Handler;
use App\{{entityName}}\Application\Handler\Update{{entityName}}Handler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class {{entityName}}Controller extends AbstractController
{

    public function __construct(
        private Get{{entityName}}Handler $get{{entityName}}Handler,
        private GetAll{{entityName}}Handler $getAll{{entityName}}Handler,
        private Create{{entityName}}Handler $create{{entityName}}Handler,
        private Delete{{entityName}}Handler $delete{{entityName}}Handler,
        private Update{{entityName}}Handler $update{{entityName}}Handler
    ) {}

    #[Route('/{{entityNameLower}}s', methods: ['GET'])]
    public function getAll{{entityName}}s()
    {
        ${{entityNameLower}}s = $this->getAll{{entityName}}Handler->handle();
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

        ${{entityNameLower}} = $this->get{{entityName}}Handler->handle($id);
        return $this->json(${{entityNameLower}});
    }

    #[Route('/{{entityNameLower}}', methods: ['POST'])]
    public function create{{entityName}}(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        ${{entityNameLower}}DTO = new {{entityName}}DTO($data);

        $result = $this->create{{entityName}}Handler->handle(${{entityNameLower}}DTO);

        if (isset($result['errors'])) {
            return $this->json($result['errors'], Response::HTTP_BAD_REQUEST);
        }

        return $this->json($result['{{entityNameLower}}'], Response::HTTP_CREATED);
    }

    #[Route('/{{entityNameLower}}/{id}', methods: ['DELETE'])]
    public function delete{{entityName}}(int $id): Response
    {
        if ($this->delete{{entityName}}Handler->handle($id)) {
            return $this->json(null, Response::HTTP_NO_CONTENT);
        }

        return $this->json(['error' => '{{entityName}} not found'], Response::HTTP_NOT_FOUND);
    }

    #[Route('/{{entityNameLower}}/{id}', methods: ['PUT'])]
    public function update{{entityName}}(Request $request, int $id): Response
    {
        $data = json_decode($request->getContent(), true);

        ${{entityNameLower}}DTO = new {{entityName}}DTO($data);

        ${{entityNameLower}} = $this->update{{entityName}}Handler->handle($id, ${{entityNameLower}}DTO);

        if (!${{entityNameLower}}) {
            return $this->json(['error' => '{{entityName}} not found'], Response::HTTP_NOT_FOUND);
        }

        return $this->json(${{entityNameLower}});
    }
}
