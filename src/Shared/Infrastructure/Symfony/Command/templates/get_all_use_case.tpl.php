<?php

namespace App\{{entityName}}\Application\UseCase;

use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class GetAll{{entityName}}UseCase
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function execute(): array
    {
        ${{entityNameLower}}s = $this->{{entityNameLower}}Repository->getAll();

        return ${{entityNameLower}}s;
    }
}
