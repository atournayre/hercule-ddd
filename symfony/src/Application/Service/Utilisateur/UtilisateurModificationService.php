<?php

namespace App\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\AbreviationNonUniqueException;
use App\Application\Exception\EmailInvalideException;
use App\Application\Exception\EmailNonUniqueException;
use App\Application\VO\Utilisateur\UtilisateurModificationVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Exception\ServiceNotFoundException;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;

class UtilisateurModificationService
{
    /**
     * @var UtilisateurService
     */
    private $utilisateurService;
    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function __construct(UtilisateurService $utilisateurService, UtilisateurRepositoryInterface $utilisateurRepository)
    {
        $this->utilisateurService = $utilisateurService;
        $this->utilisateurRepository = $utilisateurRepository;
    }

    /**
     * @param Utilisateur $utilisateur
     * @param UtilisateurModificationVO $utilisateurModificationVO
     * @return Utilisateur
     * @throws AbreviationNonUniqueException
     * @throws EmailNonUniqueException
     * @throws AbreviationInvalideException
     * @throws EmailInvalideException
     * @throws UtilisateurValidationException
     * @throws ServiceNotFoundException
     */
    public function modifier(Utilisateur $utilisateur, UtilisateurModificationVO $utilisateurModificationVO): Utilisateur
    {
        $utilisateurModificationVO->setUtilisateurRepository($this->utilisateurRepository);

        if ($this->lEmailDeLUtilisateurAChange($utilisateur, $utilisateurModificationVO)) {
            $utilisateurModificationVO->verifierUniciteEmail($utilisateurModificationVO->email);
        }

        if ($this->lAbreviationDeLUtilisateurAChange($utilisateur, $utilisateurModificationVO)) {
            $lAbreviationEstUnique = $this->utilisateurService->lAbreviationEstUnique($utilisateurModificationVO->abreviation);
            if (!$lAbreviationEstUnique) {
                throw new AbreviationNonUniqueException($utilisateurModificationVO->abreviation);
            }
        }

        $utilisateur
            ->setEmail($utilisateurModificationVO->email)
            ->setNom($utilisateurModificationVO->nom)
            ->setAbreviation($utilisateurModificationVO->abreviation)
            ->setPrenom($utilisateurModificationVO->prenom);

        $utilisateur->verifierValidite();

        $utilisateur = $this->utilisateurRepository->sauvegarder($utilisateur);

        return $utilisateur;
    }

    private function lEmailDeLUtilisateurAChange(Utilisateur $utilisateur, UtilisateurModificationVO $utilisateurModificationVO): bool
    {
        return $utilisateur->getEmail() !== $utilisateurModificationVO->email;
    }

    private function lAbreviationDeLUtilisateurAChange(Utilisateur $utilisateur, UtilisateurModificationVO $utilisateurModificationVO): bool
    {
        return $utilisateur->getAbreviation() !== $utilisateurModificationVO->abreviation;
    }
}
