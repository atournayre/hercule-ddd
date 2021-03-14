<?php

namespace App\Application\VO\Utilisateur;

use App\Application\Exception\EmailInvalideException;
use App\Application\Exception\EmailNonUniqueException;
use App\Domain\Exception\ServiceNotFoundException;
use App\Domain\Interfaces\Utilisateur\UtilisateurValidationInterface;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;
use App\Domain\Utils\RegexPattern;

class UtilisateurVO implements UtilisateurValidationInterface
{
    public $email;
    public $nom;
    public $prenom;
    public $abreviation;

    /**
     * @var UtilisateurRepositoryInterface
     */
    private $utilisateurRepository;

    public function isEmailInvalide(): bool
    {
        return empty($this->email)
            || !preg_match(RegexPattern::EMAIL, $this->email);
    }

    public function isNomInvalide(): bool
    {
        return empty(trim($this->nom));
    }

    public function isPrenomInvalide(): bool
    {
        return empty(trim($this->prenom));
    }

    public function isAbreviationInvalide(): bool
    {
        return empty($this->abreviation)
            || !preg_match(RegexPattern::ABREVIATION_VALIDATION, $this->abreviation);
    }

    /**
     * @param UtilisateurRepositoryInterface $utilisateurRepository
     */
    public function setUtilisateurRepository(UtilisateurRepositoryInterface $utilisateurRepository): void
    {
        $this->utilisateurRepository = $utilisateurRepository;
    }

    /**
     * @param string|null $email
     * @throws EmailInvalideException
     * @throws EmailNonUniqueException
     * @throws ServiceNotFoundException
     */
    public function verifierUniciteEmail(?string $email = null): void
    {
        if (is_null($this->utilisateurRepository)) {
            throw new ServiceNotFoundException(UtilisateurRepositoryInterface::class);
        }

        $utilisateur = $this->utilisateurRepository->findParEmail($email ?? $this->email);

        if (!is_null($utilisateur)) {
            throw new EmailNonUniqueException($this->email);
        }
    }
}
