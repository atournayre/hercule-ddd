<?php

namespace App\Domain\Interfaces\Utilisateur;

interface UtilisateurValidationInterface
{
    public function isEmailInvalide(): bool;

    public function isNomInvalide(): bool;

    public function isPrenomInvalide(): bool;

    public function isAbreviationInvalide(): bool;
}
