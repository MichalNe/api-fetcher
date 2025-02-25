<?php

namespace App\Application\Strategy;

use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;

#[AutoconfigureTag('resource.strategy')]
interface ResourceStrategyInterface
{
    public function fetch(string $resourceName, string $option): ResourceOutputInterface;

    public function canBeUse(string $resourceName): bool;
}