<?php

namespace App\Domain\Entity\Utilisateur;

use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationInvalideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurEmailInvalideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNomInvalideException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurPrenomInvalideException;
use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface
{
    const ROLE_PAR_DEFAUT = 'ROLE_USER';

    const EMAIL_PATTERN = '/^.+\@\S+\.\S+$/';
    const ABREVIATION_VALIDATION_PATTERN = '/^[A-Z]{3}$/';

    protected $email;
    protected $password;
    protected $roles = [];
    protected $nom;
    protected $prenom;
    protected $abreviation;

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

    public function isEmailValide(): bool
    {
        if (empty($this->email) || !preg_match(self::EMAIL_PATTERN, $this->email)) {
            return false;
        }
        return true;
    }

    public function isNomValide(): bool
    {
        return !empty(trim($this->nom));
    }

    public function isPrenomValide(): bool
    {
        return !empty(trim($this->prenom));
    }

    public function isAbreviationValide(): bool
    {
        if (empty($this->abreviation) || !preg_match(self::ABREVIATION_VALIDATION_PATTERN, $this->abreviation)) {
            return false;
        }
        return true;
    }

    /**
     * @return bool
     * @throws UtilisateurEmailInvalideException
     * @throws UtilisateurNomInvalideException
     * @throws UtilisateurPrenomInvalideException
     * @throws UtilisateurAbreviationInvalideException
     */
    public function isValide(): bool
    {
        if (!$this->isEmailValide()) {
            throw new UtilisateurEmailInvalideException();
        }
        if (!$this->isNomValide()) {
            throw new UtilisateurNomInvalideException();
        }
        if (!$this->isPrenomValide()) {
            throw new UtilisateurPrenomInvalideException();
        }
        if (!$this->isAbreviationValide()) {
            throw new UtilisateurAbreviationInvalideException();
        }
        return true;
    }
}
