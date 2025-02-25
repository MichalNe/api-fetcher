<?php

namespace App\Application\Strategy\Point;

use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class PointSerializer extends Serializer implements SerializerInterface
{
    public function __construct() {
        $normalizers = [
            new ArrayDenormalizer(),
            new ObjectNormalizer(
                nameConverter: new CamelCaseToSnakeCaseNameConverter(),
                propertyTypeExtractor: new ReflectionExtractor(),
                defaultContext: [
                    ObjectNormalizer::DISABLE_TYPE_ENFORCEMENT => true,
                ],
            ),
        ];

        $encoders = [new JsonEncoder()];

        parent::__construct($normalizers, $encoders);
    }
}