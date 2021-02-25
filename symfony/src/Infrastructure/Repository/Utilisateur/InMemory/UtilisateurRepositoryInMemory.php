<?php

namespace App\Infrastructure\Repository\Utilisateur\InMemory;

use App\Application\Exception\AbreviationInvalideException;
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

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws AbreviationInvalideException
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur
    {
        if (empty(trim($abreviation))) {
            throw new AbreviationInvalideException($abreviation);
        }

        foreach (self::$utilisateurs as $utilisateur) {
            if ($utilisateur->getAbreviation() === $abreviation) {
                return $utilisateur;
            }
        }
        return null;
    }

    public function sauvegarder(Utilisateur $utilisateur): Utilisateur
    {
        $utilisateurs = self::$utilisateurs;
        array_push($utilisateurs, $utilisateur);
        $dernierIdInsere = array_keys($utilisateurs)[count($utilisateurs)-1];
        return $utilisateurs[$dernierIdInsere];
    }
}