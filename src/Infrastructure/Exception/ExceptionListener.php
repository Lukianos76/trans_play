<?php

namespace App\Infrastructure\Exception;

use App\Application\Exception\ElementNotFoundException;
use App\Application\Exception\ValidationException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class ExceptionListener
{
    private string $environment;

    public function __construct(private LoggerInterface $logger, string $environment)
    {
        $this->environment = $environment;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $response = new JsonResponse();

        if ($exception instanceof ValidationException) {
            $errors = [];
            foreach ($exception->getErrors() as $violation) {
                $errors[] = [
                    'field' => $violation->getPropertyPath(),
                    'message' => $violation->getMessage(),
                ];
            }
            $response->setData(['errors' => $errors]);
            $response->setStatusCode(JsonResponse::HTTP_BAD_REQUEST);
            $this->logger->error('Validation error', ['errors' => $errors]);
        } elseif ($exception instanceof ElementNotFoundException) {
            $response->setData(['error' => $exception->getMessage()]);
            $response->setStatusCode(JsonResponse::HTTP_NOT_FOUND);
            $this->logger->error('Element not found', ['message' => $exception->getMessage()]);
        } elseif ($exception instanceof HttpExceptionInterface) {
            $message = $this->environment === 'prod' ? 'An error occurred' : $exception->getMessage();
            $response->setData(['error' => $message]);
            $response->setStatusCode($exception->getStatusCode());
            $this->logger->error('HTTP exception', ['message' => $exception->getMessage()]);
        } else {
            $message = $this->environment === 'prod' ? 'Internal Server Error' : $exception->getMessage();
            $response->setData(['error' => $message]);
            $response->setStatusCode(JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
            $this->logger->critical('Internal server error', ['exception' => $exception]);
        }

        $event->setResponse($response);
    }
}
