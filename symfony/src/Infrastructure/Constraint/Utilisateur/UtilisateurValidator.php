<?php

namespace App\Infrastructure\Constraint\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur as UtilisateurEntity;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class UtilisateurValidator extends ConstraintValidator
{
    /**
     * @param UtilisateurEntity|mixed $value
     * @param Constraint $constraint
     */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Utilisateur) {
            throw new UnexpectedTypeException($constraint, Utilisateur::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        if ($value->isEmailInvalide()) {
            $this->context->buildViolation($constraint->emailMessage)
                ->setCode(Utilisateur::INVALID_EMAIL_CODE_ERROR)
                ->atPath($constraint->emailPath)
                ->addViolation();
        }

        if ($value->isNomInvalide()) {
            $this->context->buildViolation($constraint->nomMessage)
                ->setCode(Utilisateur::INVALID_NOM_CODE_ERROR)
                ->atPath($constraint->nomPath)
                ->addViolation();
        }

        if ($value->isPrenomInvalide()) {
            $this->context->buildViolation($constraint->prenomMessage)
                ->setCode(Utilisateur::INVALID_PRENOM_CODE_ERROR)
                ->atPath($constraint->prenomPath)
                ->addViolation();
        }

        if ($value->isAbreviationInvalide()) {
            $this->context->buildViolation($constraint->abreviationMessage)
                ->setCode(Utilisateur::INVALID_ABREVIATION_CODE_ERROR)
                ->atPath($constraint->abreviationPath)
                ->addViolation();
        }
    }
}
