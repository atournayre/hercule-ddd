<?php

namespace App\Tests\Application\Service\Utilisateur;

use App\Application\Service\Utilisateur\UtilisateurListeService;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurInMemoryPierre;
use App\Infrastructure\Repository\Utilisateur\InMemory\UtilisateurRepositoryInMemory;
use PHPUnit\Framework\TestCase;

class UtilisateurListeServiceTest extends TestCase
{
    /**
     * @var UtilisateurRepositoryInMemory
     */
    private $utilisateurListeService;

    protected function setUp()
    {
        parent::setUp();
        $this->utilisateurListeService = new UtilisateurListeService(new UtilisateurRepositoryInMemory());
    }

    public function testListe()
    {
        UtilisateurRepositoryInMemory::$utilisateurs = [
            UtilisateurInMemoryPierre::ID => new UtilisateurInMemoryPierre(),
        ];

        $utilisateurListeDTO = $this->utilisateurListeService->liste();
        $premierUtilisateur = current($utilisateurListeDTO);
        $this->assertNotNull($premierUtilisateur->email);
    }

    public function testListeVide()
    {
        $this->expectException(UtilisateurNonTrouveException::class);
        $this->utilisateurListeService->liste();
    }
}