<?php

namespace App\{{entityName}}\Infrastructure\Symfony\Validator;

use App\{{entityName}}\Domain\Validator\{{entityName}}ValidatorInterface;
use App\Shared\Infrastructure\Symfony\Validator\SymfonyValidator;
use Symfony\Component\Validator\Constraints as Assert;

class Symfony{{entityName}}Validator extends SymfonyValidator implements {{entityName}}ValidatorInterface
{
    public function validate(array $data)
    {
        $constraints = new Assert\Collection([
        ]);

        return $this->validator->validate($data, $constraints);
    }
}
