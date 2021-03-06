<?php

namespace StudyncoBundle\Repository;

/**
 * FieldRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FieldRepository extends \Doctrine\ORM\EntityRepository
{

    public function getFieldsByCategory($id)
    {
        $query = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.category = :catId')
            ->setParameter('catId',$id)
            ->getQuery();

        return $query->getResult();
    }
}
