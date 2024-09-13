<?php

namespace App\{{entityName}}\Application\UseCase;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Domain\Entity\{{entityName}};
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class Create{{entityName}}UseCase
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository, private ValidatorInterface $validator) {}

    public function execute({{entityName}}DTO ${{entityNameLower}}DTO): array
    {
        $errors = $this->validator->validate(${{entityNameLower}}DTO);

        if (count($errors) > 0) {
            return ['errors' => $errors];
        }

        ${{entityNameLower}} = new {{entityName}}(${{entityNameLower}}DTO->toArray());
        $this->{{entityNameLower}}Repository->create(${{entityNameLower}}, true);

        return ['{{entityNameLower}}' => ${{entityNameLower}}];
    }
}
