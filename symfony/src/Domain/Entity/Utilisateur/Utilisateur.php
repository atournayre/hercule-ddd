<?php

namespace App\Domain\Entity\Utilisateur;

use Symfony\Component\Security\Core\User\UserInterface;

class Utilisateur implements UserInterface
{
    const ROLE_USER = 'ROLE_USER';

    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $password;
    protected $roles = [];
    protected $resetToken;
    protected $abreviation;

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

    public function setEmail(string $email): self
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

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getAbreviation(): string
    {
        return $this->abreviation;
    }

    public function setAbreviation(string $abreviation): self
    {
        $this->abreviation = $abreviation;
        return $this;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;
        return $this;
    }

    public function prePersist()
    {
        $this->nom = strtoupper($this->nom);
        $this->abreviation = strtoupper($this->abreviation);

        return $this;
    }

    public function preUpdate()
    {
        $this->nom = strtoupper($this->nom);
        $this->abreviation = strtoupper($this->abreviation);

        return $this;
    }
}