<?php

namespace App\Application\Service\Utilisateur;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;

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

    /**
     * @return UtilisateurListeDTO[]|array
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array
    {
        return $this->utilisateurRepository->liste();
    }
}
