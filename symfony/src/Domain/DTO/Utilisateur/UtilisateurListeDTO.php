<?php

namespace App\Domain\DTO\Utilisateur;

class UtilisateurListeDTO
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $nomComplet;

    /**
     * @var string
     */
    public $email;

    public function __construct(
        ?int $id = null,
        ?string $nomComplet = null,
        ?string $email = null
    )
    {
        $this->id = $id;
        $this->nomComplet = $nomComplet;
        $this->email = $email;
    }
}
