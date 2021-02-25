<?php

namespace App\Domain\Repository\Utilisateur;

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
}