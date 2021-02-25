<?php

namespace App\Domain\Repository\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\EmailInvalideException;
use App\Domain\Entity\Utilisateur\Utilisateur;

interface UtilisateurRepositoryInterface
{
    /**
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailInvalideException
     */
    public function findParEmail(?string $email): ?Utilisateur;

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws AbreviationInvalideException
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur;

    public function sauvegarder(Utilisateur $utilisateur): Utilisateur;
}