<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Utilisateur\UtilisateurListeService;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UtilisateurController extends AbstractController
{

    public function liste(UtilisateurListeService $utilisateurListe)
    {
        $listeUtilisateurs = [];
        try {
            $listeUtilisateurs = $utilisateurListe->liste();
        } catch (UtilisateurNonTrouveException $exception) {
            $this->addFlash('error', $exception->getMessage());
        }

        return $this->render('utilisateur/liste.html.twig', [
            'liste_utilisateurs' => $listeUtilisateurs,
        ]);
    }
}