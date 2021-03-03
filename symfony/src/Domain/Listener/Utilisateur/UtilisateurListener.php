<?php

namespace App\Domain\Listener\Utilisateur;

use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Service\MajusculeService;

class UtilisateurListener
{
    /**
     * @var MajusculeService
     */
    private $majusculeService;

    public function __construct(MajusculeService $majusculeService)
    {
        $this->majusculeService = $majusculeService;
    }

    public function preFlush(Utilisateur $utilisateur): Utilisateur
    {
        $nomEnMajuscules = $this->majusculeService->convertir($utilisateur->getNom());

        $utilisateur->setNom($nomEnMajuscules);

        return $utilisateur;
    }
}
