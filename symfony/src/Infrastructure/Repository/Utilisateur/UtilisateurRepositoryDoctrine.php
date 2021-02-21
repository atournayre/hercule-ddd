<?php

namespace App\Infrastructure\Repository\Utilisateur;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

class UtilisateurRepositoryDoctrine extends ServiceEntityRepository implements UtilisateurRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Utilisateur::class);
    }

    /**
     * @return array|UtilisateurListeDTO[]
     * @throws UtilisateurNonTrouveException
     */
    public function liste(): array
    {
        $utilisateurs = $this->createQueryBuilder('u')
            ->select(
                sprintf(
                    'NEW %s(
                        u.id,
                        CONCAT_WS(\' \', u.prenom, u.nom),
                        u.email
                    )',
                    UtilisateurListeDTO::class
                )
            )
            ->addOrderBy('u.prenom', Criteria::ASC)
            ->addOrderBy('u.nom', Criteria::ASC)
            ->getQuery()
            ->getArrayResult();

        if (0 === count($utilisateurs)) {
            throw new UtilisateurNonTrouveException();
        }

        return $utilisateurs;
    }
}