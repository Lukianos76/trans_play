<?php

namespace App\Infrastructure\Doctrine\Listener;

use App\Domain\Entity\File\File;
use App\Domain\FileSystem\FileSystemInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class DoctrineFileDeletionListener
{
    private FileSystemInterface $fileSystem;

    public function __construct(FileSystemInterface $fileSystem)
    {
        $this->fileSystem = $fileSystem;
    }

    public function preRemove(LifecycleEventArgs $args): void
    {
        $entity = $args->getObject();

        if (!$entity instanceof File) {
            return;
        }

        $filePath = $entity->getPath();
        $this->fileSystem->delete(['path' => $filePath]);
    }
}
