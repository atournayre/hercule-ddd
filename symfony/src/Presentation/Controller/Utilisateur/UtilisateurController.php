<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Service\Utilisateur\UtilisateurCreationService;
use App\Application\Service\Utilisateur\UtilisateurListeService;
use App\Application\Service\Utilisateur\UtilisateurModificationService;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurController extends AbstractController
{
    const LISTE_EXCEPTION_MESSAGE = 'Une erreur s\'est produite lors de récupération de la liste des utilisateurs.';

    public function liste(UtilisateurListeService $utilisateurListe): Response
    {
        try {
            $listeUtilisateurs = $utilisateurListe->liste();
        } catch (UtilisateurNonTrouveException $exception) {
            $this->addFlash('error', $exception->getMessage());
        } catch (Exception $exception) {
            $this->addFlash('error', self::LISTE_EXCEPTION_MESSAGE);
        }

        return $this->render('utilisateur/liste.html.twig', [
            'liste_utilisateurs' => $listeUtilisateurs ?? [],
        ]);
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
