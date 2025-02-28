<?php

declare(strict_types=1);

namespace App\Application\Transformer\Point;

use App\Application\DTO\Point\PointInputFormDTO;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Serializer\SerializerInterface;

class PointTransformer implements DataTransformerInterface
{
    public function __construct(
        private SerializerInterface $serializer,
    ) {
    }

    public function transform(mixed $value): mixed
    {
        return $value;
    }

    public function reverseTransform(mixed $value): PointInputFormDTO
    {
        if (isset($value['city']) && is_string($value['city'])) {
            $value['city'] = $this->transformFirstLetterToUpperCase($value['city']);
        }

        return $this->serializer->deserialize(json_encode($value), PointInputFormDTO::class, 'json');
    }

    private function transformFirstLetterToUpperCase(string $text): string
    {
        return ucfirst(strtolower($text));
    }
}