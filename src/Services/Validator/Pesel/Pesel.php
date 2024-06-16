<?php

namespace App\Services\Validator\Pesel;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class Pesel extends Constraint
{
    public $message = 'The value "{{ value }}" is not a valid PESEL.';
}