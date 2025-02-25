<?php

namespace App\Application;

use App\Application\Strategy\ResourceOutputInterface;
use App\Application\Strategy\ResourceStrategy;

class ApiFetcherService
{
    public function __construct(
        private ResourceStrategy $resourceStrategy,
    ) {
    }

    public function fetch(string $resourceName, string $option): ResourceOutputInterface
    {
        $fetcher = $this->resourceStrategy->getStrategy($resourceName);

        return $fetcher->fetch($resourceName, $option);
    }
}