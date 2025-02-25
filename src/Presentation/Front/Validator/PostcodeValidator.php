<?php

namespace App\Presentation\Front\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PostcodeValidator extends ConstraintValidator
{
    private const string POSTCODE_REGEX = '/^[0-9]{2}-[0-9]{3}$/';
    public function validate(mixed $value, Constraint $constraint)
    {
        if (!preg_match(self::POSTCODE_REGEX, $value)) {
            $this->context->buildViolation($constraint->message)
                ->setCode(Postcode::VIOLATION_CODE)
                ->addViolation()
            ;
        }
    }
}