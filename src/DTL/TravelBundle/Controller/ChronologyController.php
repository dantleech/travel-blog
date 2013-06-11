<?php

namespace DTL\TravelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ChronologyController extends Controller
{
    public function getDm()
    {
        $dm = $this->get('doctrine_phpcr.odm.default_document_manager');
        return $dm;
    }

    public function getRepo()
    {
        return $this->getDm()->getRepository('DTLTravelBundle:ChronoDate');
    }

    public function indexAction()
    {
        $dates = $this->getRepo()->getDates()->toArray();

        usort($dates, function ($a, $b) {
            if ($a->getDate() > $b->getDate()) {
                return false;
            }

            return true;
        });

        return $this->render('DTLTravelBundle:Chronology:list.html.twig', array(
            'dates' => $dates
        ));
    }

    public function dateAction(Request $request, $contentDocument)
    {
        $date = $contentDocument;
        return $this->render('DTLTravelBundle:Chronology:date.html.twig', array(
            'date' => $date
        ));
    }
}
