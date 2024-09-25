<?php

namespace App\Application\Controller\Game;

use App\Application\Exception\ElementNotFoundException;
use App\Application\Exception\ValidationException;
use App\Application\DTO\Game\GameDTO;
use App\Application\UseCase\Game\CreateGameUseCase;
use App\Application\UseCase\Game\DeleteGameUseCase;
use App\Application\UseCase\Game\GetAllGameUseCase;
use App\Application\UseCase\Game\GetGameUseCase;
use App\Application\UseCase\Game\UpdateGameUseCase;
use App\Application\Exception\InvalidIdException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

final class GameController extends AbstractController
{

    public function __construct(
        private SerializerInterface $serializer,
        private GetGameUseCase $getGameUseCase,
        private GetAllGameUseCase $getAllGameUseCase,
        private CreateGameUseCase $createGameUseCase,
        private DeleteGameUseCase $deleteGameUseCase,
        private UpdateGameUseCase $updateGameUseCase,
    ) {}

    #[Route('/games', methods: ['GET'])]
    public function getAllGames()
    {
        $games = $this->getAllGameUseCase->execute();
        return $this->json($games, Response::HTTP_OK, [], ['groups' => ['game']]);
    }

    #[Route('/game/{gameId}', methods: ['GET'])]
    public function getGame($gameId)
    {
        if (!$gameId) {
            throw new InvalidIdException('game');
        }

        if (!is_numeric($gameId)) {
            throw new InvalidIdException('game');
        }

        $game = $this->getGameUseCase->execute($gameId);
        return $this->json($game, Response::HTTP_OK, [], ['groups' => ['game']]);
    }

    #[Route('/game', methods: ['POST'])]
    public function createGame(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $gameDTO = new GameDTO($data);

        try {
            $game = $this->createGameUseCase->execute($gameDTO);
        } catch (ValidationException $e) {
            throw $e;
        }

        return $this->json($game, Response::HTTP_CREATED, [], ['groups' => ['game']]);
    }

    #[Route('/game/{gameId}', methods: ['DELETE'])]
    public function deleteGame($gameId): Response
    {
        try {
            $this->deleteGameUseCase->execute($gameId);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }


        return $this->json([], Response::HTTP_NO_CONTENT);
    }

    #[Route('/game/{gameId}', methods: ['PUT'])]
    public function updateGame(Request $request, $gameId): Response
    {
        $data = json_decode($request->getContent(), true);

        $gameDTO = new GameDTO($data);

        try {
            $game = $this->updateGameUseCase->execute($gameId, $gameDTO);
        } catch (ElementNotFoundException $e) {
            throw $e;
        }

        return $this->json($game, Response::HTTP_OK, [], ['groups' => ['game']]);
    }
}
