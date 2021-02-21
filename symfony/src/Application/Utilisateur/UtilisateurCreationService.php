<?php

namespace App\Application\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
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

    public function creer(UtilisateurFormVO $utilisateurFormVO): int
    {
        $utilisateur = $this->utilisateurFactory->creer($utilisateurFormVO->email, $utilisateurFormVO->nom, $utilisateurFormVO->prenom, $utilisateurFormVO->abreviation);

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur->getId();
    }
}