<?php

namespace PIdev\AllforkidsBundle\Repository;

/**
 * CompteReduRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CompteReduRepository extends \Doctrine\ORM\EntityRepository
{
    public function TrouverCompte($Enfant)
{


 $q=$this->getEntityManager()->createQuery("SELECT cmp FROM PIdevAllforkidsBundle:CompteRedu cmp WHERE cmp.enfant= :Enfant")
     ->setParameter('Enfant',$Enfant);
 return $q->getResult();
}
}
