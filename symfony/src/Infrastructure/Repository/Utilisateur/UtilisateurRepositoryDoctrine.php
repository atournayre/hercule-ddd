<?php

namespace App\Infrastructure\Repository\Utilisateur;

use App\Domain\DTO\Utilisateur\UtilisateurListeDTO;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurAbreviationVideException;
use App\Domain\Entity\Utilisateur\Utilisateur;
use App\Domain\Entity\Utilisateur\Exception\UtilisateurNonTrouveException;
use App\Domain\Exception\EmailVideException;
use App\Domain\Repository\Utilisateur\UtilisateurRepositoryInterface;
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
     * @param string|null $email
     * @return Utilisateur|null
     * @throws EmailVideException
     */
    public function findParEmail(?string $email): ?Utilisateur
    {
        if (!$email) {
            throw new EmailVideException($email);
        }
        return $this->findOneBy(['email' => $email]);
    }

    /**
     * @param string|null $abreviation
     * @return Utilisateur|null
     * @throws UtilisateurAbreviationVideException
     */
    public function findParAbreviation(?string $abreviation): ?Utilisateur
    {
        if (!$abreviation) {
            throw new UtilisateurAbreviationVideException();
        }
        return $this->findOneBy(['abreviation' => $abreviation]);
    }
}
