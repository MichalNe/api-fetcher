<?php

declare(strict_types=1);

namespace App\Presentation\Front\Validator;

use App\Application\DTO\Point\PointInputFormDTO;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class StreetWithPostcodeValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$value instanceof PointInputFormDTO) {
            throw new UnexpectedTypeException($value, StreetWithPostcode::class);
        }

        if ($value->street && !$value->postcode) {
            $this->context->buildViolation($constraint->message)
                ->setCode(StreetWithPostcode::VIOLATION_CODE)
                ->addViolation()
            ;
        }
    }
}