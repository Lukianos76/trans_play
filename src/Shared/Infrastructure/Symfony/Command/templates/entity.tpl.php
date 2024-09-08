<?php

namespace App\{{entityName}}\Domain\Entity;

use App\Shared\Domain\Entity\Entity;

class {{entityName}} extends Entity
{
    public function __construct(array ${{entityNameLower}}Data)
    {
        if (isset(${{entityNameLower}}Data['id'])) {
            parent::__construct(${{entityNameLower}}Data['id']);
        }
    }
}
