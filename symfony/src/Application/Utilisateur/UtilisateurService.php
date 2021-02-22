<?php

namespace App\Application\Utilisateur;

use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurService
{
    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function findParId(int $utilisateurId): Utilisateur
    {
        return $this->utilisateurRepository->findParId($utilisateurId);
    }
}