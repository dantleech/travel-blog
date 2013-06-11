<?php

namespace DTL\TravelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MapController extends Controller
{
    public function getDm()
    {
        $dm = $this->get('doctrine_phpcr.odm.default_document_manager');
        return $dm;
    }

    public function getRepo()
    {
        return $this->getDm()->getRepository('SandboxMediaBundle:Media');
    }

    public function indexAction(Request $request)
    {
        $qb = $this->getRepo()->createQueryBuilder();
        $qb->where($qb->expr()->andx(
            $qb->expr()->neq('longitude', ''),
            $qb->expr()->neq('latitude', '')
        ));
        $qb->addOrderBy('timestamp', 'asc');
        $q = $qb->getQuery();
        $res = $q->getResult();

        return $this->render(
            'DTLTravelBundle:Map:index.html.twig', array(
                'medias' => $res
        ));
    }
}
