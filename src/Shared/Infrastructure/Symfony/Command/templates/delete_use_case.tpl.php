<?php

namespace App\{{entityName}}\Application\UseCase;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class Delete{{entityName}}UseCase
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function execute(int ${{entityNameLower}}Id): bool
    {
        return $this->{{entityNameLower}}Repository->delete(${{entityNameLower}}Id, true);
    }
}
