<?php

namespace App\Domain\Entity\Utilisateur\Repository;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationVideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Exception\EmailVideException;

interface UtilisateurRepositoryInterface
{
    /**
     * @return array|UtilisateurListeDTO[]
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array;

    public function sauvegarder(Utilisateur $utilisateur): Utilisateur;

    /**
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailVideException
     */
    public function findParEmail(?string $email): ?Utilisateur;

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws UtilisateurAbreviationVideException
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur;

    public function findParId(int $id): ?Utilisateur;
}