<?php

namespace App\Tests\Domain\Entity\Utilisateur;

use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Domain\Factory\Utilisateur\UtilisateurFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UtilisateurTest extends KernelTestCase
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

    public function testLEmailEstValideAvecEmailNull()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $this->assertFalse($utilisateur->isEmailValide());
    }

    public function testLEmailEstValideAvecEmailVide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('');
        $this->assertFalse($utilisateur->isEmailValide());
    }

    public function testLEmailEstValideAvecEmailIncorrect()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('a@a');
        $this->assertFalse($utilisateur->isEmailValide());
    }

    public function testLEmailEstValideAvecEmailValide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('a@a.com');
        $this->assertTrue($utilisateur->isEmailValide());
    }

    public function testLeNomEstValideNomNull()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null);
        $this->assertFalse($utilisateur->isNomValide());
    }

    public function testLeNomEstValideNomVide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, '');
        $this->assertFalse($utilisateur->isNomValide());
    }

    public function testLeNomEstValideEspacesSeulement()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, '  ');
        $this->assertFalse($utilisateur->isNomValide());
    }

    public function testLeNomEstValideNomValide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, 'DUPONT');
        $this->assertTrue($utilisateur->isNomValide());
    }

    // TODO testLeNomEstEnMajuscules
    // La mise en majuscule relève-t-elle du métier et donc de la factory ?

    public function testLePrenomEstValidePrenomValide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, 'Marie');
        $this->assertTrue($utilisateur->isPrenomValide());
    }

    public function testLAbreviationEstValideAbreviationNull()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, null, null);
        $this->assertFalse($utilisateur->isAbreviationValide());
    }

    public function testLAbreviationEstValideAbreviationVide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, null, '');
        $this->assertFalse($utilisateur->isAbreviationValide());
    }

    public function testLAbreviationEstValideAbreviationEspacesSeulement()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, null, '  ');
        $this->assertFalse($utilisateur->isAbreviationValide());
    }

    public function testLAbreviationEstValideAbreviationNonAlphanumerique()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, null, 'DU:');
        $this->assertFalse($utilisateur->isAbreviationValide());
    }

    public function testLAbreviationEstValideAbreviationValide()
    {
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur(null, null, null, 'DUM');
        $this->assertTrue($utilisateur->isAbreviationValide());
    }

    public function testLUtilisateurEstInvalideAvecEmailInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur();
        $utilisateur->isValide();
    }

    public function testLUtilisateurEstInvalideAvecNomInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('a@a.com');
        $utilisateur->isValide();
    }

    public function testLUtilisateurEstInvalideAvecPrenomInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('a@a.com', 'DUPONT');
        $utilisateur->isValide();
    }

    public function testLUtilisateurEstInvalideAvecAbreviationInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);
        $utilisateur = $this->utilisateurFactory->creerUnUtilisateur('a@a.com', 'DUPONT', 'Marie');
        $utilisateur->isValide();
    }
}
