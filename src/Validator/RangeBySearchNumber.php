<?php

namespace App\Validator;

use Attribute;
use Symfony\Component\Validator\Constraint;

#[Attribute]
class RangeBySearchNumber extends Constraint
{
    /** @var string  */
    public string $message = 'Интервал по этому номеру не найден';
}