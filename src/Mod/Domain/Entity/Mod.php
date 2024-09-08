<?php

namespace App\Mod\Domain\Entity;

use App\Shared\Domain\Entity\Entity;

class Mod extends Entity
{

    private string $name;
    private string $description;
    private string $version;
    private string $url;

    public function __construct(array $modData)
    {
        if (isset($modData['id'])) {
            parent::__construct($modData['id']);
        }
        $this->name = $modData['name'];
        $this->description = $modData['description'];
        $this->version = $modData['version'];
        $this->url = $modData['url'];
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
}
