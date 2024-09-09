<?php

use PHPUnit\Framework\TestCase;
use App\Mod\Domain\Validator\ModValidatorInterface;

class ModValidatorInterfaceTest extends TestCase
{
    public function testValidateMethodExists()
    {
        $reflection = new ReflectionClass(ModValidatorInterface::class);
        $this->assertTrue($reflection->hasMethod('validate'), 'Method validate does not exist');
    }

    public function testValidateMethodIsPublic()
    {
        $reflection = new ReflectionClass(ModValidatorInterface::class);
        $method = $reflection->getMethod('validate');
        $this->assertTrue($method->isPublic(), 'Method validate is not public');
    }

    public function testValidateMethodParameters()
    {
        $reflection = new ReflectionClass(ModValidatorInterface::class);
        $method = $reflection->getMethod('validate');
        $parameters = $method->getParameters();
        $this->assertCount(1, $parameters, 'Method validate does not have exactly one parameter');
        $this->assertEquals('data', $parameters[0]->getName(), 'Parameter name is not data');
        $this->assertTrue($parameters[0]->hasType(), 'Parameter data does not have a type');
        $this->assertEquals('array', $parameters[0]->getType()->getName(), 'Parameter data is not of type array');
    }
}
