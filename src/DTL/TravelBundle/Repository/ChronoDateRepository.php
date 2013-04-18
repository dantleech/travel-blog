<?php

namespace DTL\TravelBundle\Repository;

use Doctrine\ODM\PHPCR\DocumentRepository;

class ChronoDateRepository extends DocumentRepository
{
    public function getDates()
    {
        $qb = $this->createQueryBuilder();
        $qb->orderBy('date', 'asc');
        $q = $qb->getQuery();
        return $q->getResult();
    }
}
