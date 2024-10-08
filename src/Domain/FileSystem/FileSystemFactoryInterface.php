<?php

namespace App\Domain\FileSystem;

interface FileSystemFactoryInterface
{
    public function __construct(string $type, array $config);
    public function create(): FileSystemInterface;
}
