<?php

namespace App\Infrastructure\Constraint\Utilisateur;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class Utilisateur extends Constraint
{
    const INVALID_EMAIL_CODE_ERROR = 'a1e5f87d-eeaf-450a-86f3-afefba29b6b8';
    const INVALID_NOM_CODE_ERROR = 'b8469a3b-0f93-41ce-b99d-52bd5fe61e31';
    const INVALID_PRENOM_CODE_ERROR = 'cc5afa8e-aebd-4579-9ea7-8b9c0fa4c9ff';
    const INVALID_ABREVIATION_CODE_ERROR = '22ce6642-0b22-42ef-99a8-20b35bf8ebdc';

    public $utilisateur;

    public $objectMessage = 'La vérification de validité ne peut être effectuée que sur un utilisateur.';
    public $emailMessage = 'L\'email de l\'utilisateur est invalide.';
    public $nomMessage = 'Le nom de l\'utilisateur est invalide.';
    public $prenomMessage = 'Le prénom de l\'utilisateur est invalide.';
    public $abreviationMessage = 'L\'abréviation de l\'utilisateur est invalide.';
}
