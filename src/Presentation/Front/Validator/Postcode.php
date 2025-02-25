<?php

namespace App\Presentation\Front\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Postcode extends Constraint
{
    public const string VIOLATION_CODE = 'POSTCODE_VIOLATION';
    public string $message = 'Postcode is invalid. Correct format: XX-XXX';

    public function getTargets(): string
    {
        return self::PROPERTY_CONSTRAINT;
    }
}