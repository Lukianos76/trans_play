<?php

namespace App\Shared\Infrastructure\Symfony\Validator;

use Symfony\Component\Validator\Validator\ValidatorInterface;

abstract class SymfonyValidator
{
    public function __construct(protected ValidatorInterface $validator) {}
}
