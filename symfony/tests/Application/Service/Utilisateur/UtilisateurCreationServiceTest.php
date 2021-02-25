<?php

namespace App\Tests\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationNonUniqueException;
use App\Application\Exception\EmailNonUniqueException;
use App\Application\Service\Utilisateur\UtilisateurCreationService;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Application\VO\Utilisateur\UtilisateurVO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurValidationException;
use App\Domain\Factory\Utilisateur\UtilisateurFactory;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class UtilisateurCreationServiceTest extends TestCase
{
    /**
     * @var UtilisateurCreationService
     */
    private $utilisateurCreationService;

    protected function setUp()
    {
        parent::setUp();
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);
        $utilisateurFactory = new UtilisateurFactory();
        $this->utilisateurCreationService = new UtilisateurCreationService(
            $utilisateurService,
            $utilisateurFactory,
            $utilisateurRepository
        );
    }

    public function testLUtilisateurEstCree()
    {
        $utilisateurVO = new UtilisateurVO();
        $utilisateurVO->email = UtilisateurInMemoryPierre::EMAIL;
        $utilisateurVO->abreviation = UtilisateurInMemoryPierre::ABREVIATION;
        $utilisateurVO->nom = UtilisateurInMemoryPierre::NOM;
        $utilisateurVO->prenom = UtilisateurInMemoryPierre::PRENOM;
        $utilisateur = $this->utilisateurCreationService->creer($utilisateurVO);
        $this->assertNotNull($utilisateur);
    }

    public function testErreurEmailUniqueLorsDeLaCreation()
    {
        $this->expectException(EmailNonUniqueException::class);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];
        $utilisateurVO = new UtilisateurVO();
        $utilisateurVO->email = UtilisateurInMemoryPierre::EMAIL;
        $this->utilisateurCreationService->creer($utilisateurVO);
    }

    public function testErreurAbreviationUniqueLorsDeLaCreation()
    {
        $this->expectException(AbreviationNonUniqueException::class);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];
        $utilisateurVO = new UtilisateurVO();
        $utilisateurVO->email = 'email@est.unique';
        $utilisateurVO->abreviation = UtilisateurInMemoryPierre::ABREVIATION;
        $this->utilisateurCreationService->creer($utilisateurVO);
    }

    public function testLUtilisateurEstInvalide()
    {
        $this->expectException(UtilisateurValidationException::class);
        $utilisateurVO = new UtilisateurVO();
        $utilisateurVO->email = UtilisateurInMemoryPierre::EMAIL;
        $utilisateurVO->abreviation = UtilisateurInMemoryPierre::ABREVIATION;
        $utilisateurVO->nom = null;
        $this->utilisateurCreationService->creer($utilisateurVO);
    }

    public function testlUtilisateurEstSauvegarde()
    {
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];
        $utilisateurVO = new UtilisateurVO();
        $utilisateurVO->email = 'email@est.unique';
        $utilisateurVO->abreviation = 'EEU';
        $utilisateurVO->nom = 'nom';
        $utilisateurVO->prenom = 'prenom';
        $utilisateur = $this->utilisateurCreationService->creer($utilisateurVO);
        $this->assertEquals($utilisateur->getAbreviation(), 'EEU');
    }
}