<?php

namespace App\Application\Service\Utilisateur;

use App\Application\Exception\EmailInvalideException;
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
}