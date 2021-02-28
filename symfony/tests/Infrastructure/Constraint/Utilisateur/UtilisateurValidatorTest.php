<?php

namespace App\Tests\Infrastructure\Constraint\Utilisateur;

use App\Infrastructure\Constraint\Utilisateur\Utilisateur;
use App\Infrastructure\Constraint\Utilisateur\UtilisateurValidator;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Test\ConstraintValidatorTestCase;

class UtilisateurValidatorTest extends ConstraintValidatorTestCase
{
    protected function createValidator()
    {
        return new UtilisateurValidator();
    }

    public function testNullIsValid()
    {
        $this->validator->validate(null, new Utilisateur());

        $this->assertNoViolation();
    }

    public function testEmailNullEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setEmail(null);

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->emailMessage)
            ->setCode(Utilisateur::INVALID_EMAIL_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->emailPath))
            ->assertRaised();
    }

    public function testEmailVideEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setEmail('');

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->emailMessage)
            ->setCode(Utilisateur::INVALID_EMAIL_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->emailPath))
            ->assertRaised();
    }

    public function testEmailEspacesSeulementEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setEmail('  ');

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->emailMessage)
            ->setCode(Utilisateur::INVALID_EMAIL_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->emailPath))
            ->assertRaised();
    }

    public function testEmailIncorrectEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setEmail('email@incorrect');

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->emailMessage)
            ->setCode(Utilisateur::INVALID_EMAIL_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->emailPath))
            ->assertRaised();
    }

    public function testEmailCorrectEstValide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setEmail('email@correct.fr');

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->assertNoViolation();
    }

    public function testNomNullEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setNom(null);

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->nomMessage)
            ->setCode(Utilisateur::INVALID_NOM_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->nomPath))
            ->assertRaised();
    }

    public function testPrenomNullEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setPrenom(null);

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->prenomMessage)
            ->setCode(Utilisateur::INVALID_PRENOM_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->prenomPath))
            ->assertRaised();
    }

    public function testAbreviationNullEstInvalide()
    {
        $utilisateur = new UtilisateurInMemoryPierre();
        $utilisateur->setAbreviation(null);

        $constraint = new Utilisateur(['utilisateur' => 'value']);

        $this->setObject($utilisateur);

        $this->validator->validate($utilisateur, $constraint);

        $this->buildViolation($constraint->abreviationMessage)
            ->setCode(Utilisateur::INVALID_ABREVIATION_CODE_ERROR)
            ->atPath(sprintf('property.path.%s', $constraint->abreviationPath))
            ->assertRaised();
    }
}
