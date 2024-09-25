<?php

namespace App\Domain\FileSystem;

interface FileSystemInterface
{
    public function upload($file): array;
    public function delete(array $filePath): void;
}
