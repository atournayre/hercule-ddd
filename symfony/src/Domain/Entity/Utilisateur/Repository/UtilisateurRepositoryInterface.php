<?php

namespace App\Domain\Entity\Utilisateur\Repository;

interface UtilisateurRepositoryInterface
{
    /**
     * @return array|UtilisateurListeDTO[]
     */
    public function liste(): array;
}