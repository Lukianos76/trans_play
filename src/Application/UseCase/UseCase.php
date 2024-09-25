<?php

namespace App\Application\UseCase;

use App\Application\Exception\ValidationException;

abstract class UseCase
{
    protected function validate($validator, $dto, array $fieldsToValidate = [])
    {
        $errors = $validator->validate($dto, $fieldsToValidate);

        if (count($errors) > 0) {
            throw new ValidationException($errors);
        }
    }
}
