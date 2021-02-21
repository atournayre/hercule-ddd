<?php

namespace App\Application\Utilisateur;

use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Factory\Utilisateur\UtilisateurFactory;

class UtilisateurCreationService
{
    /**
     * @var UtilisateurFactory
     */
    private $utilisateurFactory;
    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurFactory $utilisateurFactory, UtilisateurRepositoryInterface $utilisateurRepository)
    {
        $this->utilisateurFactory = $utilisateurFactory;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    public function creer(string $email, string $nom, string $prenom, string $abreviation): int
    {
        $utilisateur = $this->utilisateurFactory->creer($email, $nom, $prenom, $abreviation);

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur->getId();
    }
}