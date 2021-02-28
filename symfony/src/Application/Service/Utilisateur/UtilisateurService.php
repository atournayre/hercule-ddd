<?php

namespace App\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\EmailInvalideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;

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

    /**
     * @param string|null $email
     * @return bool
     * @throws EmailInvalideException
     */
    public function lEmailEstUnique(?string $email): bool
    {
        $utilisateur = $this->utilisateurRepository->findParEmail($email);
        return is_null($utilisateur);
    }

    /**
     * @param string|null $abreviation
     * @return bool
     * @throws AbreviationInvalideException
     */
    public function lAbreviationEstUnique(?string $abreviation): bool
    {
        $utilisateur = $this->utilisateurRepository->findParAbreviation($abreviation);
        return is_null($utilisateur);
    }

    /**
     * @param int $id
     * @return Utilisateur
     * @throws UtilisateurNonTrouveException
     */
    public function findParId(int $id): Utilisateur
    {
        return $this->utilisateurRepository->findParId($id);
    }
}