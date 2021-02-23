<?php

namespace App\Application\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationExisteException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationVideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurEmailExisteException;
use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Exception\ChampInvalideException;
use App\Domain\Exception\EmailInvalideException;
use App\Domain\Exception\EmailVideException;
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
    /**
     * @var UtilisateurService
     */
    private $utilisateurService;

    public function __construct(UtilisateurFactory $utilisateurFactory, UtilisateurRepositoryInterface $utilisateurRepository, UtilisateurService $utilisateurService)
    {
        $this->utilisateurFactory = $utilisateurFactory;
        $this->utilisateurRepository = $utilisateurRepository;
        $this->utilisateurService = $utilisateurService;
    }

    /**
     * @param UtilisateurFormVO $utilisateurFormVO
     * @return int
     * @throws ChampInvalideException
     * @throws EmailInvalideException
     * @throws EmailVideException
     * @throws UtilisateurAbreviationExisteException
     * @throws UtilisateurEmailExisteException
     * @throws UtilisateurAbreviationVideException
     */
    public function __invoke(UtilisateurFormVO $utilisateurFormVO): int
    {
        $utilisateurParEmail = $this->utilisateurService->findParEmail($utilisateurFormVO->email);
        if ($utilisateurParEmail) {
            throw new UtilisateurEmailExisteException($utilisateurFormVO->email);
        }

        $utilisateurParAbreviation = $this->utilisateurService->findParAbreviation($utilisateurFormVO->abreviation);
        if ($utilisateurParAbreviation) {
            throw new UtilisateurAbreviationExisteException($utilisateurFormVO->abreviation);
        }

        $utilisateur = $this->utilisateurFactory->creer($utilisateurFormVO->email, $utilisateurFormVO->nom, $utilisateurFormVO->prenom, $utilisateurFormVO->abreviation);
        $utilisateur = $utilisateur->prePersist();

        if ($utilisateur->estValide()) {
            $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);
        }

        return $utilisateur->getId();
    }
}