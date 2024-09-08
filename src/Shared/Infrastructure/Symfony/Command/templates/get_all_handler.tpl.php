<?php

namespace App\{{entityName}}\Application\Handler;

use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class GetAll{{entityName}}Handler
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function handle(): array
    {
        ${{entityNameLower}}s = $this->{{entityNameLower}}Repository->getAll();

        return ${{entityNameLower}}s;
    }
}
