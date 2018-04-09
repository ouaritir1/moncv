<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Loisir repository
 */
 class LoisirRepository extends EntityRepository
 {
     /**
      * Find ...
      */
     public function findAllLoisirs()
     {
         $qBuilder = $this
            ->getEntityManager()
            ->createQueryBuilder();
            
         $qBuilder->select('f');
         $qBuilder->from('AppBundle:Loisir', 'f');
          
         $result = $qBuilder->getQuery()->getResult();
          
         return $result;
     }
 }
