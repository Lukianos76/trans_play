<?php

namespace App\Mod\Application\UseCase;

use App\Mod\Application\DTO\ModDTO;
use App\Mod\Domain\Entity\Mod;
use App\Mod\Domain\Repository\ModRepositoryInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final class CreateModUseCase
{
    public function __construct(private ModRepositoryInterface $modRepository, private ValidatorInterface $validator) {}

    public function execute(ModDTO $modDTO): array
    {
        $errors = $this->validator->validate($modDTO);

        if (count($errors) > 0) {
            return ['errors' => $errors];
        }

        $mod = new Mod($modDTO->toArray());
        $this->modRepository->create($mod, true);

        return ['mod' => $mod];
    }
}
