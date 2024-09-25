<?php

namespace App\Application\UseCase;

use App\Application\Exception\ValidationException;

abstract class UseCase
{
    protected function validate($validator, $dto)
    {
        $errors = $validator->validate($dto);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}
