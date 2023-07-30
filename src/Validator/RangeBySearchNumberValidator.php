<?php

namespace App\Validator;

use App\Repository\RangeRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class RangeBySearchNumberValidator extends ConstraintValidator
{
    /**
     * @param RangeRepository $rangeRepository
     */
    public function __construct(private readonly RangeRepository $rangeRepository)
    {
    }

    /**
     * @param mixed $value
     * @param Constraint $constraint
     * @return void
     * @throws NonUniqueResultException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$this->rangeRepository->findRangeBySearchNumber($value)) {
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }
}