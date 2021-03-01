<?php

namespace App\Domain\Repository\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\EmailInvalideException;
use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
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

    /**
     * @return UtilisateurListeDTO[]|array
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array;

    /**
     * @param int $id
     * @return Utilisateur
     * @throws UtilisateurNonTrouveException
     */
    public function findParId(int $id): Utilisateur;
}