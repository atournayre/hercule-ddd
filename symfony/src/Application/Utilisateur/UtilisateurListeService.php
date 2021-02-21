<?php

namespace App\Application\Utilisateur;

use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;

class UtilisateurListeService
{
    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurRepositoryInterface $utilisateurRepository)
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function liste()
    {
        return $this->utilisateurRepository->liste();
    }
}