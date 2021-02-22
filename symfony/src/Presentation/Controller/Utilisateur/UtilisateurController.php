<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Utilisateur\UtilisateurCreationService;
use App\Application\Utilisateur\UtilisateurListeService;
use App\Application\VO\Utilisateur\UtilisateurFormVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Infrastructure\Form\Utilisateur\UtilisateurType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurController extends AbstractController
{

    public function liste(UtilisateurListeService $utilisateurListe): Response
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

    public function creer(Request $request, UtilisateurCreationService $utilisateurCreationService): Response
    {
        $utilisateurFormVO = new UtilisateurFormVO();

        $form = $this->createForm(UtilisateurType::class, $utilisateurFormVO);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('error', 'Le formulaire n\'est pas valide.');
            }
            if ($form->isValid()) {
                try {

                    $utilisateur = $utilisateurCreationService->creer($utilisateurFormVO);

                    $this->addFlash('success', 'L\'utilisateur a été créé.');

                    return $this->redirectToRoute('utilisateur_liste');
                } catch (Exception $exception) {

                }
            }
        }


        return $this->render('utilisateur/formulaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}