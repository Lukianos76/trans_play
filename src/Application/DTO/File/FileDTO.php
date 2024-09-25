<?php

namespace App\Application\DTO\File;

use App\Application\DTO\DTO;

class FileDTO extends DTO
{
    public string $name;
    public string $originalName;
    public string $path;
}
