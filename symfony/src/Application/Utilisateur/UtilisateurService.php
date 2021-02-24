<?php

namespace App\Application\Utilisateur;

use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationVideException;
use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Exception\EmailVideException;

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

    /**
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailVideException
     */
    public function findParEmail(?string $email): ?Utilisateur
    {
        return $this->utilisateurRepository->findParEmail($email);
    }

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws UtilisateurAbreviationVideException
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur
    {
        return $this->utilisateurRepository->findParAbreviation($abreviation);
    }
}