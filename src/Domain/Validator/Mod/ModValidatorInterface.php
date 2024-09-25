<?php

namespace App\Domain\Validator\Mod;

use App\Application\DTO\Mod\ModDTO;

interface ModValidatorInterface
{
    public function validate(ModDTO $modDTO);
}
