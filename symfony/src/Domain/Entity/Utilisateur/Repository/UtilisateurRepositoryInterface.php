<?php

namespace App\Domain\Entity\Utilisateur\Repository;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Entity\Utilisateur\Utilisateur;

interface UtilisateurRepositoryInterface
{
    /**
     * @return array|UtilisateurListeDTO[]
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array;

    public function sauvegarder(Utilisateur $utilisateur): Utilisateur;

    public function findParEmail(string $email): ?Utilisateur;

    public function findParAbreviation(string $abreviation): ?Utilisateur;
}