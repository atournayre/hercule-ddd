<?php

namespace App\Presentation\Controller\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\AbreviationNonUniqueException;
use App\Application\Exception\EmailInvalideException;
use App\Application\Exception\EmailNonUniqueException;
use App\Application\Service\Utilisateur\UtilisateurCreationService;
use App\Application\Service\Utilisateur\UtilisateurListeService;
use App\Application\Service\Utilisateur\UtilisateurModificationService;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Application\VO\Utilisateur\UtilisateurVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Infrastructure\Form\Utilisateur\UtilisateurType;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UtilisateurController extends AbstractController
{
    const LISTE_EXCEPTION_MESSAGE = 'Une erreur s\'est produite lors de récupération de la liste des utilisateurs.';

    const CREER_FORMULAIRE_INVALIDE_MESSAGE = 'Le formulaire n\'est pas valide.';
    const CREER_FORMULAIRE_VALIDE_MESSAGE = 'L\'utilisateur a été créé.';
    const CREER_EXCEPTION_MESSAGE = 'Une erreur s\'est produite lors de la création de l\'utilisateur.';

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
        $utilisateurVO = new UtilisateurVO();

        $form = $this->createForm(UtilisateurType::class, $utilisateurVO);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if (!$form->isValid()) {
                $this->addFlash('error', self::CREER_FORMULAIRE_INVALIDE_MESSAGE);
            }
            if ($form->isValid()) {
                try {
                    $utilisateur = ($utilisateurCreationService)($utilisateurVO);

                    $this->addFlash('success', self::CREER_FORMULAIRE_VALIDE_MESSAGE);

                    return $this->redirectToRoute('utilisateur_modifier', [
                        'id' => $utilisateur->getId(),
                    ]);
                } catch (AbreviationInvalideException|AbreviationNonUniqueException|EmailInvalideException|EmailNonUniqueException|UtilisateurValidationException $exception) {
                    $this->addFlash('error', $exception->getMessage());
                } catch (Exception $e) {
                    $this->addFlash('error', self::CREER_EXCEPTION_MESSAGE);
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
        exit('Not implemented');
    }
}
