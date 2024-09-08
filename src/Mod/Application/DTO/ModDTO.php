<?php

namespace App\Mod\Application\DTO;

use App\Shared\Application\DTO\DTO;

class ModDTO extends DTO
{
    public string $name;
    public string $description;
    public string $version;
    public string $url;
}
