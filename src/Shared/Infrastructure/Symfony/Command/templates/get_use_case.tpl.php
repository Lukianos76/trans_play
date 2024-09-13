<?php

namespace App\{{entityName}}\Application\UseCase;

use App\{{entityName}}\Domain\Entity\{{entityName}};
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class Get{{entityName}}UseCase
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function execute(int ${{entityNameLower}}Id): {{entityName}}
    {
        ${{entityNameLower}} = $this->{{entityNameLower}}Repository->getOneById(${{entityNameLower}}Id);

        return ${{entityNameLower}};
    }
}
