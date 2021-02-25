<?php

namespace App\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\AbreviationNonUniqueException;
use App\Application\Exception\EmailInvalideException;
use App\Application\Exception\EmailNonUniqueException;
use App\Application\VO\Utilisateur\UtilisateurVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Factory\Utilisateur\UtilisateurFactory;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;

class UtilisateurCreationService
{
    /**
     * @var UtilisateurService
     */
    private $utilisateurService;
    /**
     * @var UtilisateurFactory
     */
    private $utilisateurFactory;
    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function __construct(
        UtilisateurService $utilisateurService,
        UtilisateurFactory $utilisateurFactory,
        UtilisateurRepositoryInterface $utilisateurRepository
    )
    {
        $this->utilisateurService = $utilisateurService;
        $this->utilisateurFactory = $utilisateurFactory;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    /**
     * @param UtilisateurVO $utilisateurVO
     * @return Utilisateur
     * @throws AbreviationNonUniqueException
     * @throws EmailInvalideException
     * @throws EmailNonUniqueException
     * @throws AbreviationInvalideException
     * @throws UtilisateurValidationException
     */
    public function creer(UtilisateurVO $utilisateurVO): Utilisateur
    {
        $lEmailEstUnique = $this->utilisateurService->lEmailEstUnique($utilisateurVO->email);
        if (!$lEmailEstUnique) {
            throw new EmailNonUniqueException();
        }
        $lAbreviationEstUnique = $this->utilisateurService->lAbreviationEstUnique($utilisateurVO->abreviation);
        if (!$lAbreviationEstUnique) {
            throw new AbreviationNonUniqueException();
        }
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(
            $utilisateurVO->email,
            $utilisateurVO->nom,
            $utilisateurVO->prenom,
            $utilisateurVO->abreviation
        );

        $utilisateur->isValide();

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur;
    }
}