<?php

namespace App\Application\Strategy;

use App\Application\Exception\ResourceStrategyNotFoundException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;

class ResourceStrategy
{
    public function __construct(
        /** @var ResourceStrategyInterface[] $resource */
        #[AutowireIterator('resource.strategy')]
        private iterable $resources,
        private LoggerInterface $logger,
    ) {
    }

    public function getStrategy(string $resourceName): ResourceStrategyInterface
    {
        foreach ($this->resources as $resource) {
            if ($resource->canBeUse($resourceName)) {
                return $resource;
            }
        }

        $this->logger->error('Resource not found');

        throw new ResourceStrategyNotFoundException();
    }
}