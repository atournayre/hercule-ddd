<?php

namespace App\Application\Utilisateur;

use App\Application\VO\Utilisateur\UtilisateurFormVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationExisteException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurEmailExisteException;
use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;

class UtilisateurModificationService
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
     * @param Utilisateur $utilisateur
     * @param UtilisateurFormVO $utilisateurFormVO
     * @return int
     * @throws UtilisateurAbreviationExisteException
     * @throws UtilisateurEmailExisteException
     */
    public function __invoke(Utilisateur $utilisateur, UtilisateurFormVO $utilisateurFormVO): int
    {
        if ($utilisateur->getEmail() !== $utilisateurFormVO->email) {
            $utilisateurParEmail = $this->utilisateurRepository->findParEmail($utilisateurFormVO->email);
            if ($utilisateurParEmail) {
                throw new UtilisateurEmailExisteException($utilisateurFormVO->email);
            }
        }

        if ($utilisateur->getAbreviation() !== $utilisateurFormVO->abreviation) {
            $utilisateurParAbreviation = $this->utilisateurRepository->findParAbreviation($utilisateurFormVO->abreviation);
            if ($utilisateurParAbreviation) {
                throw new UtilisateurAbreviationExisteException($utilisateurFormVO->abreviation);
            }
        }

        $utilisateur
            ->setNom($utilisateurFormVO->nom)
            ->setPrenom($utilisateurFormVO->prenom)
            ->setAbreviation($utilisateurFormVO->abreviation)
            ->setEmail($utilisateurFormVO->email);

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur->getId();
    }
}