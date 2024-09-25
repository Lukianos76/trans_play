<?php

namespace App\Domain\Entity\Mod;

use App\Domain\Entity\File\File;
use App\Domain\Entity\Entity;

class ModFile extends Entity
{
    private Mod $mod;
    private File $file;

    public function __construct(array $modFileData)
    {
        if (isset($modFileData['id'])) {
            parent::__construct($modFileData['id']);
        }
        $this->mod = $modFileData['mod'];
        $this->file = $modFileData['file'];
    }

    public function getMod()
    {
        return $this->mod;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setMod($mod)
    {
        $this->mod = $mod;
    }

    public function setFile($file)
    {
        $this->file = $file;
    }
}
