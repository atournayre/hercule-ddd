<?php

namespace App\Tests\Application\Service\Utilisateur;

use App\Application\Exception\AbreviationInvalideException;
use App\Application\Exception\EmailInvalideException;
use App\Application\Service\Utilisateur\UtilisateurService;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class UtilisateurServiceTest extends TestCase
{
    public function testEmailUtilisateurUnique()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);

        $lEmailEstUnique = $utilisateurService->lEmailEstUnique('email@est.unique');
        $this->assertTrue($lEmailEstUnique);
    }

    public function testEmailUtilisateurExisteDeja()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $lEmailEstUnique = $utilisateurService->lEmailEstUnique(UtilisateurInMemoryPierre::EMAIL);
        $this->assertFalse($lEmailEstUnique);
    }

    public function testEmailUniqueAvecEmailInvalide()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);

        $this->expectException(EmailInvalideException::class);
        $utilisateurService->lEmailEstUnique(null);
    }

    public function testAbreviationUtilisateurUnique()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);

        $lAbreviationEstUnique = $utilisateurService->lAbreviationEstUnique('ABU');
        $this->assertTrue($lAbreviationEstUnique);
    }

    public function testAbreviationUtilisateurAbreviationDeja()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $lAbreviationEstUnique = $utilisateurService->lAbreviationEstUnique(UtilisateurInMemoryPierre::ABREVIATION);
        $this->assertFalse($lAbreviationEstUnique);
    }

    public function testAbreviationUniqueAvecAbreviationInvalide()
    {
        $utilisateurRepository = new UtilisateurRepositoryInMemory();
        $utilisateurService = new UtilisateurService($utilisateurRepository);

        $this->expectException(AbreviationInvalideException::class);
        $utilisateurService->lAbreviationEstUnique(null);
    }
}
