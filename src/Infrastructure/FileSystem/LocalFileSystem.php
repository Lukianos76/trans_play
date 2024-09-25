<?php

namespace App\Infrastructure\FileSystem;

use App\Domain\FileSystem\FileSystemInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Uid\Uuid;

class LocalFileSystem implements FileSystemInterface
{
    private Filesystem $filesystem;
    private string $path;

    public function __construct(string $path)
    {
        $this->filesystem = new Filesystem();
        $this->path = $path;
    }

    public function upload($file): array
    {
        // Générer un UUID pour chaque fichier
        $fileUuid = Uuid::v4()->toString();
        $filename = $fileUuid . '.' . $file->guessExtension();
        $file->move($this->path, $filename);

        return [
            'originalName' => $file->getClientOriginalName(),
            'name' => $filename,
            'path' => $this->path . '/' . $filename
        ];
    }

    public function delete(array $filePath): void
    {
        try {
            $this->filesystem->remove($filePath);
        } catch (IOExceptionInterface $exception) {
            echo "An error occurred while deleting the file at " . $exception->getPath();
        }
    }
}
