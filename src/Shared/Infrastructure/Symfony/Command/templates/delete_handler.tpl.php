<?php

namespace App\{{entityName}}\Application\Handler;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class Delete{{entityName}}Handler
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function handle(int ${{entityNameLower}}Id): bool
    {
        return $this->{{entityNameLower}}Repository->delete(${{entityNameLower}}Id, true);
    }
}
