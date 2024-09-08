<?php

namespace App\{{entityName}}\Application\Handler;

use App\{{entityName}}\Application\DTO\{{entityName}}DTO;
use App\{{entityName}}\Domain\Entity\{{entityName}};
use App\{{entityName}}\Domain\Repository\{{entityName}}RepositoryInterface;

final class Update{{entityName}}Handler
{
    public function __construct(private {{entityName}}RepositoryInterface ${{entityNameLower}}Repository) {}

    public function handle(int ${{entityNameLower}}Id, {{entityName}}DTO ${{entityNameLower}}Dto): ?{{entityName}}
    {
        ${{entityNameLower}} = $this->{{entityNameLower}}Repository->getOneById(${{entityNameLower}}Id);

        if (!${{entityNameLower}}) {
            return null;
        }

        $this->{{entityNameLower}}Repository->update(${{entityNameLower}}, true);

        return ${{entityNameLower}};
    }
}
