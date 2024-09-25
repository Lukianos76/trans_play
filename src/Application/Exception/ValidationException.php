<?php

namespace App\Application\Exception;

use Exception;
use Symfony\Component\Validator\ConstraintViolationList;

class ValidationException extends Exception
{
    private ConstraintViolationList $errors;

    public function __construct(ConstraintViolationList $errors)
    {
        parent::__construct('Validation errors');
        $this->errors = $errors;
    }

    public function getErrors(): ConstraintViolationList
    {
        return $this->errors;
    }
}
