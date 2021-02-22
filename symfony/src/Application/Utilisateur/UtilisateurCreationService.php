<?php

namespace App\Application\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationExisteException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurEmailExisteException;
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

    /**
     * @param UtilisateurFormVO $utilisateurFormVO
     * @return int
     * @throws UtilisateurAbreviationExisteException
     * @throws UtilisateurEmailExisteException
     */
    public function __invoke(UtilisateurFormVO $utilisateurFormVO): int
    {
        $utilisateur = $this->utilisateurRepository->findParEmail($utilisateurFormVO->email);
        if ($utilisateur) {
            throw new UtilisateurEmailExisteException($utilisateurFormVO->email);
        }

        $utilisateur = $this->utilisateurRepository->findParAbreviation($utilisateurFormVO->abreviation);
        if ($utilisateur) {
            throw new UtilisateurAbreviationExisteException($utilisateurFormVO->abreviation);
        }

        $utilisateur = $this->utilisateurFactory->creer($utilisateurFormVO->email, $utilisateurFormVO->nom, $utilisateurFormVO->prenom, $utilisateurFormVO->abreviation);

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur->getId();
    }
}