<?php

namespace App\Application\UseCase\Mod;

use App\Application\DTO\File\FileDTO;
use App\Domain\Entity\File\File;
use App\Application\DTO\Mod\ModFileDTO;
use App\Application\Exception\BadRequestException;
use App\Domain\Entity\Mod\Mod;
use App\Domain\Entity\Mod\ModFile;
use App\Domain\Repository\File\FileRepositoryInterface;
use App\Domain\Repository\Mod\ModFileRepositoryInterface;
use App\Domain\Repository\Mod\ModRepositoryInterface;
use App\Application\UseCase\UseCase;
use App\Application\Exception\ElementNotFoundException;
use App\Domain\FileSystem\FileSystemInterface;

final class UploadModFilesUseCase extends UseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModFileRepositoryInterface $modFileRepository, private FileRepositoryInterface $fileRepository, private FileSystemInterface $fileSystem) {}

    public function execute($modId, $files): ?Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        if (!$mod) {
            throw new ElementNotFoundException('mod');
        }

        foreach ($files as $file) {
            $fileUploaded = $this->fileSystem->upload($file);

            $fileDTO = new FileDTO($fileUploaded);
            $file = new File($fileDTO->toArray());

            $this->fileRepository->create($file, true);

            $modFileDTO = new ModFileDTO([
                'mod' => $mod,
                'file' => $file
            ]);
            $modFile = new ModFile($modFileDTO->toArray());

            $this->modFileRepository->create($modFile, true);

            $mod->addFile($modFile);
        }

        $this->modRepository->update($mod, true);

        return $mod;
    }
}
