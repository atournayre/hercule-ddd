<?php

namespace App\Tests\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\EmailInvalideException;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class UtilisateurServiceTest extends TestCase
{
    /**
     * @var UtilisateurService
     */
    private $utilisateurService;

    protected function setUp()
    {
        parent::setUp();
        $this->utilisateurService = new UtilisateurService(new UtilisateurRepositoryInMemory());
    }

    public function testEmailUtilisateurUnique()
    {
        $lEmailEstUnique = $this->utilisateurService->lEmailEstUnique('email@est.unique');
        $this->assertTrue($lEmailEstUnique);
    }

    public function testEmailUtilisateurExisteDeja()
    {
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $lEmailEstUnique = $this->utilisateurService->lEmailEstUnique(UtilisateurInMemoryPierre::EMAIL);
        $this->assertFalse($lEmailEstUnique);
    }

    public function testEmailUniqueAvecEmailInvalide()
    {
        $this->expectException(EmailInvalideException::class);
        $this->utilisateurService->lEmailEstUnique(null);
    }

    public function testAbreviationUtilisateurUnique()
    {
        $lAbreviationEstUnique = $this->utilisateurService->lAbreviationEstUnique('ABU');
        $this->assertTrue($lAbreviationEstUnique);
    }

    public function testAbreviationUtilisateurAbreviationDeja()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $this->utilisateurService = new UtilisateurService($utilisateurRepository);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $lAbreviationEstUnique = $this->utilisateurService->lAbreviationEstUnique(UtilisateurInMemoryPierre::ABREVIATION);
        $this->assertFalse($lAbreviationEstUnique);
    }

    public function testAbreviationUniqueAvecAbreviationInvalide()
    {
        $this->expectException(AbreviationInvalideException::class);
        $this->utilisateurService->lAbreviationEstUnique(null);
    }

    public function testFindParIdNonExistant()
    {
        $this->expectException(UtilisateurNonTrouveException::class);
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $this->utilisateurService = new UtilisateurService($utilisateurRepository);

        $this->utilisateurService->findParId(UtilisateurInMemoryPierre::ID);
    }

    public function testFindParIdExistant()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $this->utilisateurService = new UtilisateurService($utilisateurRepository);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $utilisateur = $this->utilisateurService->findParId(UtilisateurInMemoryPierre::ID);
        $this->assertEquals(UtilisateurInMemoryPierre::EMAIL, $utilisateur->getEmail());
    }
}
