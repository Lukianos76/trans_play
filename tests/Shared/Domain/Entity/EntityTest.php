<?php

use PHPUnit\Framework\TestCase;
use App\Shared\Domain\Entity\Entity;

class EntityTest extends TestCase
{
    public function testGetId()
    {
        $entity = $this->getMockBuilder(Entity::class)
            ->setConstructorArgs([1])
            ->onlyMethods(['getId'])
            ->getMock();

        $entity->method('getId')->willReturn(1);

        $this->assertEquals(1, $entity->getId());
    }

    public function testSetId()
    {
        $entity = $this->getMockBuilder(Entity::class)
            ->setConstructorArgs([1])
            ->onlyMethods(['setId', 'getId'])
            ->getMock();

        $entity->method('getId')->willReturn(2);
        $entity->expects($this->once())
            ->method('setId')
            ->with($this->equalTo(2));

        $entity->setId(2);
        $this->assertEquals(2, $entity->getId());
    }
}
