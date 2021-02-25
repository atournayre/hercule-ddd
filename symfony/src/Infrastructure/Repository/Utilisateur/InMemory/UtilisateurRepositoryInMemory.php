<?php

namespace App\Infrastructure\Repository\Utilisateur\InMemory;

use App\Application\Exception\EmailInvalideException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;

class UtilisateurRepositoryInMemory implements UtilisateurRepositoryInterface
{
    public static $utilisateurs = [];

    public function __construct()
    {
        self::$utilisateurs = [];
    }

    /**
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailInvalideException
     */
    public function findParEmail(?string $email): ?Utilisateur
    {
        if (empty(trim($email))) {
            throw new EmailInvalideException($email);
        }

        foreach (self::$utilisateurs as $utilisateur) {
            if ($utilisateur->getEmail() === $email) {
                return $utilisateur;
            }
        }
        return null;
    }
}