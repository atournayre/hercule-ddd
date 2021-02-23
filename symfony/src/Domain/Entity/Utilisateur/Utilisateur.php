<?php

namespace App\Domain\Entity\Utilisateur;

use App\Domain\Exception\ChampInvalideException;
use App\Domain\Exception\EmailInvalideException;
use App\Domain\Exception\EmailVideException;
use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';

    // TODO extraire
    const EMAIL_PATTERN = '/^.+\@\S+\.\S+$/';

    const ABREVIATION_VALIDATION_PATTERN = '/^[A-Z]{3}$/';

    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $roles = [];
    protected $resetToken;
    protected $abreviation;

    /**
     * @var bool
     */
    private $estValide = false;

    public function getId(): int
    {
        return $this->id;
    }

    public function getRoles()
    {
        return $this->roles;
    }

    public function getPassword()
    {
        return $this->password;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getResetToken(): string
    {
        return $this->resetToken;
    }

    public function setResetToken(?string $resetToken): void
    {
        $this->resetToken = $resetToken;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getAbreviation(): string
    {
        return $this->abreviation;
    }

    public function setAbreviation(?string $abreviation): self
    {
        $this->abreviation = $abreviation;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    /**
     * @return $this
     * @throws ChampInvalideException
     * @throws EmailInvalideException
     * @throws EmailVideException
     */
    public function prePersist()
    {
        $this->nom = strtoupper($this->nom);
        $this->abreviation = strtoupper($this->abreviation);
        $this->validation();

        return $this;
    }

    /**
     * @return $this
     * @throws ChampInvalideException
     * @throws EmailInvalideException
     * @throws EmailVideException
     */
    public function preUpdate()
    {
        $this->nom = strtoupper($this->nom);
        $this->abreviation = strtoupper($this->abreviation);
        $this->validation();

        return $this;
    }

    /**
     * @return $this
     * @throws ChampInvalideException
     * @throws EmailInvalideException
     * @throws EmailVideException
     */
    public function validation(): self
    {
        $this->estValide = $this->lEmailEstValide()
            && $this->leNomEstValide()
            && $this->lePrenomEstValide()
            && $this->lAbreviationEstValide();

        return $this;
    }

    /**
     * @return bool
     */
    public function estValide(): bool
    {
        return $this->estValide;
    }

    /**
     * @return bool
     * @throws EmailInvalideException
     * @throws EmailVideException
     */
    public function lEmailEstValide(): bool
    {
        if (!$this->email) {
            throw new EmailVideException();
        }
        if (!preg_match(self::EMAIL_PATTERN, $this->email)) {
            throw new EmailInvalideException($this->email);
        }
        return true;
    }

    /**
     * @return bool
     * @throws ChampInvalideException
     */
    public function leNomEstValide(): bool
    {
        if (!$this->nom) {
            throw new ChampInvalideException('nom');
        }
        return true;
    }

    /**
     * @return bool
     * @throws ChampInvalideException
     */
    public function lePrenomEstValide(): bool
    {
        if (!$this->prenom) {
            throw new ChampInvalideException('prenom');
        }
        return true;
    }

    /**
     * @return bool
     * @throws ChampInvalideException
     */
    public function lAbreviationEstValide(): bool
    {
        if (!preg_match(self::ABREVIATION_VALIDATION_PATTERN, $this->abreviation)) {
            throw new ChampInvalideException('abréviation');
        }
        return true;
    }
}