<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Experience repository
 */
 class ExperienceRepository extends EntityRepository
 {
     /**
      * Find ...
      */
     public function findAllExperiences()
     {
         $qBuilder = $this
            ->getEntityManager()
            ->createQueryBuilder();
            
         $qBuilder->select('f');
         $qBuilder->from('AppBundle:Experience', 'f');
          
         $result = $qBuilder->getQuery()->getResult();
          
         return $result;
     }
 }
