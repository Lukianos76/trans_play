<?php

namespace App\Infrastructure\Symfony\Validator\Mod;

use App\Application\DTO\Mod\ModDTO;
use App\Domain\Validator\Mod\ModValidatorInterface;
use App\Infrastructure\Symfony\Validator\SymfonyValidator;
use Symfony\Component\Validator\Constraints as Assert;

class SymfonyModValidator extends SymfonyValidator implements ModValidatorInterface
{
    public function validate(ModDTO $modDTO, array $fieldsToValidate = [])
    {
        $constraints = [];

        if (empty($fieldsToValidate)) {
            $fieldsToValidate = ['name', 'description', 'version', 'url', 'gameId'];
        }

        if (in_array('name', $fieldsToValidate)) {
            $constraints['name'] = new Assert\NotBlank();
        }

        if (in_array('description', $fieldsToValidate)) {
            $constraints['description'] = new Assert\Optional(new Assert\NotBlank());
        }

        if (in_array('version', $fieldsToValidate)) {
            $constraints['version'] = new Assert\Optional(new Assert\NotBlank());
        }

        if (in_array('url', $fieldsToValidate)) {
            $constraints['url'] = [
                new Assert\NotBlank(),
                new Assert\Url(),
            ];
        }

        if (in_array('gameId', $fieldsToValidate)) {
            $constraints['gameId'] = new Assert\NotBlank();
        }

        $collectionConstraint = new Assert\Collection($constraints);

        return $this->validator->validate($modDTO->toArray(), $collectionConstraint);
    }
}
