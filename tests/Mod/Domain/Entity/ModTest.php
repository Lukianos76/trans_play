<?php

use PHPUnit\Framework\TestCase;
use App\Mod\Domain\Entity\Mod;



class ModTest extends TestCase
{
    private $modData;

    protected function setUp(): void
    {
        $this->modData = [
            'id' => 1,
            'name' => 'Test Mod',
            'description' => 'This is a test mod.',
            'version' => '1.0.0',
            'url' => 'http://example.com'
        ];
    }

    public function testConstructor()
    {
        $mod = new Mod($this->modData);

        $this->assertEquals($this->modData['name'], $mod->getName());
        $this->assertEquals($this->modData['description'], $mod->getDescription());
        $this->assertEquals($this->modData['version'], $mod->getVersion());
        $this->assertEquals($this->modData['url'], $mod->getUrl());
    }

    public function testSetName()
    {
        $mod = new Mod($this->modData);
        $mod->setName('New Name');

        $this->assertEquals('New Name', $mod->getName());
    }

    public function testSetDescription()
    {
        $mod = new Mod($this->modData);
        $mod->setDescription('New Description');

        $this->assertEquals('New Description', $mod->getDescription());
    }

    public function testSetVersion()
    {
        $mod = new Mod($this->modData);
        $mod->setVersion('2.0.0');

        $this->assertEquals('2.0.0', $mod->getVersion());
    }

    public function testSetUrl()
    {
        $mod = new Mod($this->modData);
        $mod->setUrl('http://newexample.com');

        $this->assertEquals('http://newexample.com', $mod->getUrl());
    }
}
