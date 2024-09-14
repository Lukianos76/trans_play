<?php

namespace App\Mod\Application\UseCase;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;
use App\Mod\Domain\Validator\ModValidatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class UpdateModUseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ModValidatorInterface $validator) {}

    public function execute(int $modId, ModDTO $modDTO): ?Mod
    {
        $mod = $this->modRepository->getOneById($modId);

        $errors = $this->validator->validate($modDTO);

        if (count($errors) > 0) {
            return ['errors' => $errors];
        }

        if (!$mod) {
            return null;
        }

        $mod->setName($modDTO->name ?? $mod->getName());
        $mod->setDescription($modDTO->description ?? $mod->getDescription());
        $mod->setVersion($modDTO->version ?? $mod->getVersion());
        $mod->setUrl($modDTO->url ?? $mod->getUrl());

        $this->modRepository->update($mod, true);

        return $mod;
    }
}
