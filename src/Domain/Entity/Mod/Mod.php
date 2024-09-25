<?php

namespace App\Domain\Entity\Mod;

use App\Domain\Entity\Entity;
use App\Domain\Entity\Game\Game;

class Mod extends Entity
{
    private string $name;
    private ?string $description;
    private ?string $version;
    private string $url;
    private $modFiles;
    private Game $game;

    public function __construct(array $modData)
    {
        if (isset($modData['id'])) {
            parent::__construct($modData['id']);
        }
        $this->name = $modData['name'];
        $this->description = $modData['description'] ?? null;
        $this->version = $modData['version'] ?? null;
        $this->url = $modData['url'];
        $this->game = $modData['game'];
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getVersion()
    {
        return $this->version;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getModFiles()
    {
        return $this->modFiles;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function setVersion($version)
    {
        $this->version = $version;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function addFile(ModFile $modFile): self
    {
        if (!$this->modFiles->contains($modFile)) {
            $this->modFiles->add($modFile);
            $modFile->setMod($this);
        }

        return $this;
    }

    public function removeFile(ModFile $modFile): self
    {
        if ($this->modFiles->contains($modFile)) {
            $this->modFiles->removeElement($modFile);
            $modFile->setMod(null);
        }

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;
        return $this;
    }
}
