<?php

namespace App\Shared\Infrastructure\FileSystem;

use App\Shared\Domain\FileSystem\FileSystemInterface;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class LocalFileSystem implements FileSystemInterface
{
    private Filesystem $filesystem;
    private string $path;

    public function __construct(string $path)
    {
        $this->filesystem = new Filesystem();
        $this->path = $path;
    }

    public function uploadFiles(array $files, string $destinationPath): array
    {
        $uploadedFiles = [];
        foreach ($files as $file) {
            if ($file instanceof UploadedFile) {
                // Générer un UUID pour chaque fichier
                $fileUuid = Uuid::uuid4()->toString();
                $filename = $fileUuid . '.' . $file->guessExtension();
                $file->move($destinationPath, $filename);
                $uploadedFiles[] = [
                    'name' => $file->getClientOriginalName(),
                    'path' => $destinationPath . $filename
                ];
            }
        }

        return $uploadedFiles;
    }

    public function deleteFile(array $filePath): void
    {
        try {
            $this->filesystem->remove($filePath);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while deleting the file at " . $exception->getPath();
        }
    }
}
