<?php

namespace App\Domain\Entity\Utilisateur\Repository;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;

interface UtilisateurRepositoryInterface
{
    /**
     * @return array|UtilisateurListeDTO[]
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array;
}