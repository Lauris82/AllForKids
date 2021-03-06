<?php

namespace PIdev\AllforkidsBundle\Repository;

/**
 * ClubRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ClubRepository extends \Doctrine\ORM\EntityRepository
{

    function findcl($no,$gouv)
    {
        $query = $this->getEntityManager()
            ->createQuery(" 
    select s from PIdevAllforkidsBundle:Club s 
    WHERE s.nom LIKE :no AND s.gouvernorat LIKE :gouv
      ")
            ->setParameter('no', '%' . $no . '%')->setParameter('gouv', '%' . $gouv . '%');
        return $query->getResult();
    }
    public function clubActualitee()
    {
        $q=$this->getEntityManager()
            ->createQuery("SELECT g FROM PIdevAllforkidsBundle:Club g  ORDER BY g.idclub DESC ");
        return $q->getFirstResult();
    }

}
