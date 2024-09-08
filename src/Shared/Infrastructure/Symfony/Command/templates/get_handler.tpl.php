<?php

namespace App\{{entityName}}\Application\Handler;

use App\{{entityName}}\Domain\Entity\{{entityName}};
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class Get{{entityName}}Handler
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function handle(int ${{entityNameLower}}Id): {{entityName}}
    {
        ${{entityNameLower}} = $this->{{entityNameLower}}Repository->getOneById(${{entityNameLower}}Id);

        return ${{entityNameLower}};
    }
}
