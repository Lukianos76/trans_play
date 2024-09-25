<?php

namespace App\Infrastructure\Symfony\Validator\Game;

use App\Application\DTO\Game\GameDTO;
use App\Domain\Validator\Game\GameValidatorInterface;
use App\Infrastructure\Symfony\Validator\SymfonyValidator;
use Symfony\Component\Validator\Constraints as Assert;

class SymfonyGameValidator extends SymfonyValidator implements GameValidatorInterface
{
    public function validate(GameDTO $gameDTO, array $fieldsToValidate = [])
    {
        $constraints = [];

        if (empty($fieldsToValidate)) {
            $fieldsToValidate = ['name'];
        }

        if (in_array('name', $fieldsToValidate)) {
            $constraints['name'] = new Assert\NotBlank();
        }

        $collectionConstraint = new Assert\Collection($constraints);

        return $this->validator->validate($gameDTO->toArray(), $collectionConstraint);
    }
}
