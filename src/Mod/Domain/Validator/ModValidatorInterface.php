<?php

namespace App\Mod\Domain\Validator;

interface ModValidatorInterface
{
    public function validate(array $data);
}
