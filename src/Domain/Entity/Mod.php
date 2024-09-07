<?php

namespace App\Domain\Entity;

class Mod extends Entity
{

    private $name;
    private $description;
    private $version;
    private $url;

    public function __construct($id, $name, $description, $version, $url)
    {
        parent::__construct($id);
        $this->name = $name;
        $this->description = $description;
        $this->version = $version;
        $this->url = $url;
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
