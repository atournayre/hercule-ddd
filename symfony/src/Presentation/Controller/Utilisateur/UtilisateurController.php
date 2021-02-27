<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Service\Utilisateur\UtilisateurCreationService;
use App\Application\Service\Utilisateur\UtilisateurListeService;
use App\Application\Service\Utilisateur\UtilisateurModificationService;
use App\Application\Service\Utilisateur\UtilisateurService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurController extends AbstractController
{
    public function liste(UtilisateurListeService $utilisateurListe): Response
    {
        exit('Not implemented');
    }

    public function creer(Request $request, UtilisateurCreationService $utilisateurCreationService): Response
    {
        exit('Not implemented');
    }

    public function modifier(
        Request $request,
        UtilisateurService $utilisateurService,
        UtilisateurModificationService $utilisateurModificationService,
        int $id
    ): Response
    {
        exit('Not implemented');
    }
}
