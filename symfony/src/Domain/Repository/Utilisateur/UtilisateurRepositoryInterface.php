<?php

namespace App\Domain\Repository\Utilisateur;

use App\Application\Exception\AbreviationInvalideExceptionInterface;
use App\Application\Exception\EmailInvalideExceptionInterface;
use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveExceptionInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;

interface UtilisateurRepositoryInterface
{
    /**
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailInvalideExceptionInterface
     */
    public function findParEmail(?string $email): ?Utilisateur;

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws AbreviationInvalideExceptionInterface
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur;

    public function sauvegarder(Utilisateur $utilisateur): Utilisateur;

    /**
     * @return UtilisateurListeDTO[]|array
     * @throws UtilisateurNonTrouveExceptionInterface
     */
    public function liste(): array;

    /**
     * @param int $id
     * @return Utilisateur
     * @throws UtilisateurNonTrouveExceptionInterface
     */
    public function findParId(int $id): Utilisateur;
}