<?php

namespace App\Presentation\Front\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_CLASS)]
class StreetWithPostcode extends Constraint
{
    public const string VIOLATION_CODE = 'STREET_WITHOUT_POSTCODE';
    public string $message = 'It is required to specify the postal code along with the street';

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}