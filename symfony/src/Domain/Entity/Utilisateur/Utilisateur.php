<?php

namespace App\Domain\Entity\Utilisateur;

use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Domain\Interfaces\Pdf\EntitePdfInterface;
use App\Domain\Interfaces\Pdf\GenererPdfInterface;
use App\Domain\Interfaces\Pdf\GenererPdfServiceInterface;
use App\Domain\Interfaces\Utilisateur\UtilisateurValidationInterface;
use App\Domain\Interfaces\ValidationInterface;
use App\Domain\Utils\RegexPattern;
use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface, UtilisateurValidationInterface, ValidationInterface, GenererPdfInterface, EntitePdfInterface
{
    const ROLE_PAR_DEFAUT = 'ROLE_USER';

    const EMAIL_INVALIDE_EXCEPTION_MESSAGE = 'L\'email de l\'utilisateur est invalide.';
    const NOM_INVALIDE_EXCEPTION_MESSAGE = 'Le nom de l\'utilisateur est invalide.';
    const PRENOM_INVALIDE_EXCEPTION_MESSAGE = 'Le prénom de l\'utilisateur est invalide.';
    const ABREVIATION_INVALIDE_EXCEPTION_MESSAGE = 'L\'abréviation de l\'utilisateur est invalide.';

    protected $id;
    protected $email;
    protected $password;
    protected $roles = [];
    protected $nom;
    protected $prenom;
    protected $abreviation;
    protected $resetToken;

    /**
     * @var GenererPdfServiceInterface
     */
    private $genererPdfService;

    public function setGenererPdfService(GenererPdfServiceInterface $genererPdfService): self
    {
        $this->genererPdfService = $genererPdfService;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getRoles(): array
    {
        if (count($this->roles) === 0) {
            $this->roles = [
                self::ROLE_PAR_DEFAUT,
            ];
        }
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getSalt()
    {
        return null;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function getAbreviation(): ?string
    {
        return $this->abreviation;
    }

    public function setAbreviation(?string $abreviation): self
    {
        $this->abreviation = $abreviation;
        return $this;
    }

    public function isEmailInvalide(): bool
    {
        return empty($this->email)
            || !preg_match(RegexPattern::EMAIL, $this->email);
    }

    public function isEmailValide(): bool
    {
        return !$this->isEmailInvalide();
    }

    public function isNomValide(): bool
    {
        return !$this->isNomInvalide();
    }

    public function isNomInvalide(): bool
    {
        return empty(trim($this->nom));
    }

    public function isPrenomValide(): bool
    {
        return !$this->isPrenomInvalide();
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

    public function isAbreviationValide(): bool
    {
        return !$this->isAbreviationInvalide();
    }

    /**
     * @throws UtilisateurValidationException
     */
    public function verifierValidite(): void
    {
        if (!$this->isEmailValide()) {
            throw new UtilisateurValidationException(self::EMAIL_INVALIDE_EXCEPTION_MESSAGE);
        }
        if (!$this->isNomValide()) {
            throw new UtilisateurValidationException(self::NOM_INVALIDE_EXCEPTION_MESSAGE);
        }
        if (!$this->isPrenomValide()) {
            throw new UtilisateurValidationException(self::PRENOM_INVALIDE_EXCEPTION_MESSAGE);
        }
        if (!$this->isAbreviationValide()) {
            throw new UtilisateurValidationException(self::ABREVIATION_INVALIDE_EXCEPTION_MESSAGE);
        }
    }

    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    /**
     * @return $this
     */
    public function preFlush(): self
    {
        $this->nom = strtoupper($this->nom);

        return $this;
    }

    public function genererPdf(): string
    {
        return $this->genererPdfService->genererPdf($this);
    }

    public function lEmailAChange(?string $email = null): bool
    {
        return $this->email !== $email;
    }
}
