<?php

namespace App\Application\DTO\Mod;

use App\Domain\Entity\File\File;
use App\Domain\Entity\Mod\Mod;
use App\Application\DTO\DTO;

class ModFileDTO extends DTO
{
    public Mod $mod;
    public File $file;
}
