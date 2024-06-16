<?php

namespace App\Services\Validator\Pesel;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class PeselValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (null === $value || '' === $value) {
            return;
        }

        if (!$this->isValidPesel($value)) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ value }}', $value)
                ->addViolation();
        }
    }

    private function isValidPesel($pesel)
    {
        if (strlen($pesel) !== 11 || !ctype_digit($pesel)) {
            return false;
        }

        $weights = [1, 3, 7, 9, 1, 3, 7, 9, 1, 3];
        $sum = 0;

        for ($i = 0; $i < 10; $i++) {
            $sum += $weights[$i] * $pesel[$i];
        }

        $checksum = (10 - $sum % 10) % 10;

        return $checksum === (int)$pesel[10];
    }
}