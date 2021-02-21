<?php

namespace App\Domain\DTO\Utilisateur;

class UtilisateurListeDTO
{
    public $id;
    public $nomComplet;
    public $email;

    public function __construct(?int $id = null, ?string $nomComplet = null, ?string $email = null)
    {
        $this->id = $id;
        $this->nomComplet = $nomComplet;
        $this->email = $email;
    }
}