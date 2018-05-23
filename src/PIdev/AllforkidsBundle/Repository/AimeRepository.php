<?php

namespace PIdev\AllforkidsBundle\Repository;

/**
 * AimeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AimeRepository extends \Doctrine\ORM\EntityRepository
{
    Public function findlikedPost($id){
        return $this->getEntityManager()
            ->createQuery('SELECT a FROM PIdevAllforkidsBundle:Aime a WHERE a.idPost LIKE  :searchItem')
            ->setParameter('searchItem',$id)
            ->getResult();
    }
}
