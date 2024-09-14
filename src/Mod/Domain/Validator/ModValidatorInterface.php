<?php

namespace App\Mod\Domain\Validator;

use App\Mod\Application\DTO\ModDTO;

interface ModValidatorInterface
{
    public function validate(ModDTO $modDTO);
}
