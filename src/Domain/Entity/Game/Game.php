<?php

namespace App\Domain\Entity\Game;

use App\Domain\Entity\Entity;

class Game extends Entity
{
    private string $name;

    public function __construct(array $gameData)
    {
        if (isset($gameData['id'])) {
            parent::__construct($gameData['id']);
        }
        $this->name = $gameData['name'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
}
