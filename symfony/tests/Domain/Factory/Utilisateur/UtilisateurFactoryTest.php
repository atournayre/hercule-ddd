<?php

namespace App\Tests\Domain\Factory\Utilisateur;

use App\Domain\Factory\Utilisateur\UtilisateurFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UtilisateurFactoryTest extends KernelTestCase
{
    /**
     * @var UtilisateurFactory
     */
    private $utilisateurFactory;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        static::bootKernel([]);
        $this->utilisateurFactory = static::$container->get(UtilisateurFactory::class);
    }

    public function testCreerUnUtilisateur(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null);
        $this->assertNotNull($utilisateur);
    }

    public function testCreerUnUtilisateurAvecEmail(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(
            'email@example.com'
        );
        $this->assertNotNull($utilisateur->getEmail());
    }

    public function testCreerUnUtilisateurAvecEmailNull(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertNull($utilisateur->getEmail());
    }

    public function testCreerUnUtilisateurAvecNom(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(
            'email@example.com',
            'DUPONT'
        );
        $this->assertNotNull($utilisateur->getNom());
    }

    public function testCreerUnUtilisateurAvecNomNull(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertNull($utilisateur->getNom());
    }

    public function testCreerUnUtilisateurAvecPrenom(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(
            'email@example.com',
            'DUPONT',
            'Marie'
        );
        $this->assertNotNull($utilisateur->getPrenom());
    }

    public function testCreerUnUtilisateurAvecPrenomNull(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertNull($utilisateur->getPrenom());
    }

    public function testCreerUnUtilisateurAvecAbreviation(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(
            'email@example.com',
            'DUPONT',
            'Marie',
            'MDU'
        );
        $this->assertNotNull($utilisateur->getAbreviation());
    }

    public function testCreerUnUtilisateurAvecAbreviationNull(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertNull($utilisateur->getAbreviation());
    }

    public function testCreerUnUtilisateurAvecMotDePasse(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertNotNull($utilisateur->getPassword());
    }

    public function testCreerUnUtilisateurAvecMotDePasseInitial(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertEquals(UtilisateurFactory::MOT_DE_PASSE_INITIAL, $utilisateur->getPassword());
    }

    public function testCreerUnUtilisateurAvecLeRoleUserParDefaut(): void
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertContains('ROLE_USER', $utilisateur->getRoles());
    }
}
