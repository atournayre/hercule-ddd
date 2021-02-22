<?php

namespace App\Infrastructure\Repository\Utilisateur;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Repository\UtilisateurRepositoryInterface;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    /**
     * @param Utilisateur $utilisateur
     * @return Utilisateur
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function sauvegarder(Utilisateur $utilisateur): Utilisateur
    {
        $this->_em->persist($utilisateur);
        $this->_em->flush();
        $this->_em->refresh($utilisateur);

        return $utilisateur;
    }

    /**
     * @param string $email
     * @return Utilisateur|null
     */
    public function findParEmail(string $email): ?Utilisateur
    {
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param string $abreviation
     * @return Utilisateur|null
     */
    public function findParAbreviation(string $abreviation): ?Utilisateur
    {
        return $this->findOneBy(['abreviation' => $abreviation]);
    }
}