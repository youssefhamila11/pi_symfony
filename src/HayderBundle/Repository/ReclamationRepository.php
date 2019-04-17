<?php

namespace HayderBundle\Repository;

/**
 * ReclamationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReclamationRepository extends \Doctrine\ORM\EntityRepository
{
    public function recherche($critere)
    {
        // automatically knows to select Products
        // the "p" is an alias you'll use in the rest of the query
        $qb = $this->createQueryBuilder('p');
        $qb
            ->orWhere(
                $qb->expr()->like('p.etat',':critere')
            )
            ->orWhere(
                $qb->expr()->like('p.typeReclamation',':critere')
            )
            ->orWhere(
                $qb->expr()->like('p.texteLibre',':critere')
            )
            ->orWhere(
                $qb->expr()->like('p.pieceJointe',':critere')
            )
            ->orWhere(
                $qb->expr()->like('p.reponse',':critere')
            )
            ->setParameter('critere', '%'.$critere.'%')

        ;

        return $qb->getQuery()->execute();
    }
}