<?php

declare(strict_types=1);

namespace App\Application\Strategy\Point;

use App\Application\DTO\Point\PointCollectionDTO;
use App\Application\Strategy\ParameterEnum;
use App\Application\Strategy\ResourceOutputInterface;
use App\Application\Strategy\ResourceStrategyEnum;
use App\Application\Strategy\ResourceStrategyInterface;
use App\Infrastructure\ApiClient;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('resource.strategy')]
class PointFetcher implements ResourceStrategyInterface
{
    public function __construct(
        private ApiClient $apiClient,
        private PointSerializer $serializer,
    ) {
    }

    public function canBeUse(string $resourceName): bool
    {
        return ResourceStrategyEnum::POINTS->value === $resourceName;
    }

    public function fetch(string $resourceName, string $option): ResourceOutputInterface
    {
        $result = $this->apiClient->fetch($resourceName, ParameterEnum::CITY->value, $option);

        return $this->serializer->deserialize(
            $result,
            PointCollectionDTO::class,
            'json'
        );
    }
}