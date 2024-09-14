<?php

namespace App\Shared\Infrastructure\FileSystem;

use App\Shared\Domain\FileSystem\FileSystemFactoryInterface;
use App\Shared\Domain\FileSystem\FileSystemInterface;
use Aws\S3\S3Client;

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
