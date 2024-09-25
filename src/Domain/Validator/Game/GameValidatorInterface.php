<?php

namespace App\Domain\Validator\Game;

use App\Application\DTO\Game\GameDTO;

interface GameValidatorInterface
{
    public function validate(GameDTO $gameDTO, array $fieldsToValidate = []);
}
