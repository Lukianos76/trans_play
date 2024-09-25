<?php

namespace App\Application\DTO\Mod;

use App\Application\DTO\DTO;
use App\Domain\Entity\Game\Game;

class ModDTO extends DTO
{
    public string $name;
    public string $description;
    public string $version;
    public string $url;
    public string $gameId;
    public Game $game;
}
