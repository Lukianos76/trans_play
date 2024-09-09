<?php

use PHPUnit\Framework\TestCase;
use App\Mod\Domain\Repository\ModRepositoryInterface;

class ModRepositoryInterfaceTest extends TestCase
{
    private $modRepository;

    protected function setUp(): void
    {
        $this->modRepository = $this->createMock(ModRepositoryInterface::class);
    }

    public function testCreate()
    {
        $mod = new stdClass(); // Replace with actual Mod object
        $this->modRepository->expects($this->once())
            ->method('create')
            ->with($mod, false);

        $this->modRepository->create($mod, false);
    }

    public function testDelete()
    {
        $id = 1;
        $this->modRepository->expects($this->once())
            ->method('delete')
            ->with($id, false)
            ->willReturn(true);

        $result = $this->modRepository->delete($id, false);
        $this->assertTrue($result);
    }

    public function testUpdate()
    {
        $mod = new stdClass(); // Replace with actual Mod object
        $this->modRepository->expects($this->once())
            ->method('update')
            ->with($mod, false);

        $this->modRepository->update($mod, false);
    }

    public function testGetAll()
    {
        $expectedMods = [new stdClass(), new stdClass()]; // Replace with actual Mod objects
        $this->modRepository->expects($this->once())
            ->method('getAll')
            ->willReturn($expectedMods);

        $mods = $this->modRepository->getAll();
        $this->assertEquals($expectedMods, $mods);
    }

    public function testGetOneById()
    {
        $id = 1;
        $expectedMod = new stdClass(); // Replace with actual Mod object
        $this->modRepository->expects($this->once())
            ->method('getOneById')
            ->with($id)
            ->willReturn($expectedMod);

        $mod = $this->modRepository->getOneById($id);
        $this->assertEquals($expectedMod, $mod);
    }
}
