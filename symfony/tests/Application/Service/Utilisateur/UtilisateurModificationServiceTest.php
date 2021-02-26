<?php

namespace App\Tests\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationNonUniqueException;
use App\Application\Exception\EmailNonUniqueException;
use App\Application\Service\Utilisateur\UtilisateurModificationService;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Application\VO\Utilisateur\UtilisateurModificationVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPaul;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class UtilisateurModificationServiceTest extends TestCase
{
    /**
     * @var UtilisateurModificationService
     */
    private $utilisateurModificationService;

    protected function setUp()
    {
        parent::setUp();
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);
        $this->utilisateurModificationService = new UtilisateurModificationService($utilisateurService, $utilisateurRepository);
    }

    public function testLUtilisateurEmailEstModifie()
    {
        $utilisateur = new UtilisateurInMemoryPierre();

        $emailModifie = UtilisateurInMemoryPierre::EMAIL.'modifie';

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->email = $emailModifie;

        $utilisateur = $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);

        $this->assertEquals($emailModifie, $utilisateur->getEmail());
    }

    public function testLUtilisateurNomEstModifie()
    {
        $utilisateur = new UtilisateurInMemoryPierre();

        $nomModifie = UtilisateurInMemoryPierre::NOM.'modifie';

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->nom = $nomModifie;

        $utilisateur = $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);

        $this->assertEquals($nomModifie, $utilisateur->getNom());
    }

    public function testLUtilisateurPrenomEstModifie()
    {
        $utilisateur = new UtilisateurInMemoryPierre();

        $prenomModifie = UtilisateurInMemoryPierre::PRENOM.'modifie';

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->prenom = $prenomModifie;

        $utilisateur = $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);

        $this->assertEquals($prenomModifie, $utilisateur->getPrenom());
    }

    public function testLUtilisateurAbreviationEstModifie()
    {
        $utilisateur = new UtilisateurInMemoryPierre();

        $abreviationModifie = 'AAA';

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->abreviation = $abreviationModifie;

        $utilisateur = $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);

        $this->assertEquals($abreviationModifie, $utilisateur->getAbreviation());
    }

    public function testErreurEmailUniqueLorsDeLaModification()
    {
        $this->expectException(EmailNonUniqueException::class);

        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
            UtilisateurInMemoryPaul::ID => new UtilisateurInMemoryPaul(),
        ];

        $utilisateur = new UtilisateurInMemoryPierre();

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->email = UtilisateurInMemoryPaul::EMAIL;

        $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);
    }

    public function testErreurAbreviationUniqueLorsDeLaModification()
    {
        $this->expectException(AbreviationNonUniqueException::class);

        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
            UtilisateurInMemoryPaul::ID => new UtilisateurInMemoryPaul(),
        ];

        $utilisateur = new UtilisateurInMemoryPierre();

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->abreviation = UtilisateurInMemoryPaul::ABREVIATION;

        $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);
    }


    public function testLUtilisateurEstInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);

        $utilisateur = new UtilisateurInMemoryPierre();

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->nom = null;

        $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);
    }


    public function testlUtilisateurEstSauvegarde()
    {
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $utilisateur = new UtilisateurInMemoryPierre();

        $utilisateurModificationVO = new UtilisateurModificationVO($utilisateur);
        $utilisateurModificationVO->email = 'email@est.unique';
        $utilisateurModificationVO->abreviation = 'EEU';
        $utilisateurModificationVO->nom = 'nom';
        $utilisateurModificationVO->prenom = 'prenom';

        $utilisateur = $this->utilisateurModificationService->modifier($utilisateur, $utilisateurModificationVO);

        $this->assertEquals($utilisateur->getAbreviation(), 'EEU');
    }
}