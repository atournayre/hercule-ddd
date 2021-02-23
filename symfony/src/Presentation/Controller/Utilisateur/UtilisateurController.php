<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Utilisateur\UtilisateurCreationService;
use App\Application\Utilisateur\UtilisateurListeService;
use App\Application\Utilisateur\UtilisateurModificationService;
use App\Application\Utilisateur\UtilisateurService;
use App\Application\VO\Utilisateur\UtilisateurFormVO;
use App\Application\VO\Utilisateur\UtilisateurModificationFormVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationExisteException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurEmailExisteException;
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
        try {
            $listeUtilisateurs = $utilisateurListe->liste();
        } catch (UtilisateurNonTrouveException $exception) {
            $this->addFlash('error', $exception->getMessage());
        } catch (Exception $exception) {
            $this->addFlash('error', 'Une erreur s\'est produite lors de récupération de la liste des utilisateurs.');
        }

        return $this->render('utilisateur/liste.html.twig', [
            'liste_utilisateurs' => $listeUtilisateurs ?? [],
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
                    $utilisateurId = ($utilisateurCreationService)($utilisateurFormVO);

                    $this->addFlash('success', 'L\'utilisateur a été créé.');

                    return $this->redirectToRoute('utilisateur_modifier', [
                        'id' => $utilisateurId,
                    ]);
                } catch (UtilisateurAbreviationExisteException|UtilisateurEmailExisteException $exception) {
                    $this->addFlash('error', $exception->getMessage());
                } catch (Exception $exception) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de la création de l\'utilisateur.');
                }
            }
        }


        return $this->render('utilisateur/formulaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function modifier(
        Request $request,
        UtilisateurService $utilisateurService,
        UtilisateurModificationService $utilisateurModificationService,
        int $id
    ): Response
    {
        $utilisateur = $utilisateurService->findParId($id);

        $utilisateurFormVO = new UtilisateurModificationFormVO($utilisateur);

        $form = $this->createForm(UtilisateurType::class, $utilisateurFormVO);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('error', 'Le formulaire n\'est pas valide.');
            }
            if ($form->isValid()) {
                try {
                    $utilisateurId = ($utilisateurModificationService)($utilisateur, $utilisateurFormVO);

                    $this->addFlash('success', 'L\'utilisateur a été modifié.');

                    return $this->redirectToRoute('utilisateur_modifier', [
                        'id' => $utilisateurId,
                    ]);
                } catch (UtilisateurAbreviationExisteException|UtilisateurEmailExisteException $exception) {
                    $this->addFlash('error', $exception->getMessage());
                } catch (Exception $exception) {
                    $this->addFlash('error', 'Une erreur s\'est produite lors de la modification de l\'utilisateur.');
                }
            }
        }


        return $this->render('utilisateur/formulaire.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}