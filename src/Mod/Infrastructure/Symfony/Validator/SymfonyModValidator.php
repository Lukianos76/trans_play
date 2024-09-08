<?php

namespace App\Mod\Infrastructure\Symfony\Validator;

use App\Mod\Domain\Validator\ModValidatorInterface;
use App\Shared\Infrastructure\Symfony\Validator\SymfonyValidator;
use Symfony\Component\Validator\Constraints as Assert;

class SymfonyModValidator extends SymfonyValidator implements ModValidatorInterface
{
    public function validate(array $data)
    {
        $constraints = new Assert\Collection([
            'name' => new Assert\NotBlank(),
            'description' => new Assert\NotBlank(),
            'version' => new Assert\NotBlank(),
            'url' => [
                new Assert\NotBlank(),
                new Assert\Url(),
            ],
        ]);

        return $this->validator->validate($data, $constraints);
    }
}
