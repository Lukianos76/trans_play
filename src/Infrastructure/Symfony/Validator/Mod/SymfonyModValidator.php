<?php

namespace App\Infrastructure\Symfony\Validator\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Infrastructure\Symfony\Validator\SymfonyValidator;
use Symfony\Component\Validator\Constraints as Assert;

class SymfonyModValidator extends SymfonyValidator implements ModValidatorInterface
{
    public function validate(ModDTO $modDTO)
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

        return $this->validator->validate($modDTO->toArray(), $constraints);
    }
}
