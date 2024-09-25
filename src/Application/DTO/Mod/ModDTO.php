<?php

namespace App\Application\DTO\Mod;

use App\Application\DTO\DTO;

class ModDTO extends DTO
{
    public string $name;
    public string $description;
    public string $version;
    public string $url;
}
