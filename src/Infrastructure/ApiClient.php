<?php

namespace App\Infrastructure;

use App\Domain\Exception\PointFetcherException;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiClient
{
    public function __construct(
        private readonly HttpClientInterface $httpClient,
        private readonly LoggerInterface $logger,
        private readonly string $url,
    ) {
    }

    public function fetch(string $resourceName, string $parameterName, string $parameterValue): string
    {
        $preparedUrl = sprintf('%s/%s?%s=%s', $this->url, $resourceName, $parameterName, $parameterValue);

        try {
            $response = $this->httpClient->request(
                Request::METHOD_GET,
                $preparedUrl,
                [
                'headers' => [
                    'Accept' => 'application/json',
                    'Content-Type' => 'application/json',
                ]
            ]);

            if ($response->getStatusCode() === Response::HTTP_OK) {
                return $response->getContent();
            } else {
                throw new PointFetcherException();
            }
        } catch (TransportExceptionInterface $e) {
            $this->logger->error(
                sprintf('[ApiClient] Error fetching data from API. URL: %s', $preparedUrl),
                [
                    'url' => $preparedUrl,
                    'exception' => $e::class,
                    'exception_message' => $e->getMessage(),
                ]
            );

            throw new PointFetcherException();
        }
    }
}