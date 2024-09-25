<?php

namespace App\Infrastructure\FileSystem;

use App\Domain\FileSystem\FileSystemFactoryInterface;
use App\Domain\FileSystem\FileSystemInterface;

class FileSystemFactory implements FileSystemFactoryInterface
{
    private string $type;
    private array $config;

    public function __construct(string $type, array $config)
    {
        $this->type = $type;
        $this->config = $config;
    }

    public function create(): FileSystemInterface
    {
        switch ($this->type) {
            case 'local':
                return new LocalFileSystem($this->config['path']);
            default:
                throw new \InvalidArgumentException(sprintf('Unsupported filesystem type "%s".', $this->type));
        }
    }
}
