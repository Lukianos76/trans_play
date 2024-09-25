<?php

namespace App\Domain\Entity\File;

use App\Domain\Entity\Entity;

class File extends Entity
{
    private string $name;
    private string $originalName;
    private string $path;

    public function __construct(array $fileData)
    {
        if (isset($fileData['id'])) {
            parent::__construct($fileData['id']);
        }
        $this->name = $fileData['name'];
        $this->originalName = $fileData['originalName'];
        $this->path = $fileData['path'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getOriginalName()
    {
        return $this->originalName;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setOriginalName($originalName)
    {
        $this->originalName = $originalName;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }
}
