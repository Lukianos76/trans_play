<?php

namespace App\Shared\Domain\FileSystem;

interface FileSystemInterface
{
    public function uploadFiles(array $files, string $destinationPath): array;
    public function deleteFile(array $filePath): void;
}
