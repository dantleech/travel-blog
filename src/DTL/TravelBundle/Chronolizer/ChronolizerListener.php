<?php

namespace DTL\TravelBundle\Chronolizer;

use Doctrine\ODM\PHPCR\Event\OnFlushEventArgs;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Cmf\Bundle\RoutingAutoBundle\Document\AutoRoute;
use PHPCR\Util\NodeHelper;
use DTL\TravelBundle\Document\ChronoDate;

class ChronolizerListener
{
    public function onFlush(OnFlushEventArgs $args)
    {
        $chronoPath = '/cms/chronology';
        $classes = array(
            'DTL\TravelBundle\Document\VoyagePost',
            'Sandbox\MediaBundle\Document\Media',
        );

        $dm = $args->getDocumentManager();
        $uow = $dm->getUnitOfWork();
        NodeHelper::createPath($dm->getPhpcrSession(), $chronoPath);
        $parent = $dm->find(null, $chronoPath);

        $scheduledInserts = $uow->getScheduledInserts();
        $scheduledUpdates = $uow->getScheduledUpdates();
        $updates = array_merge($scheduledInserts, $scheduledUpdates);

        foreach ($updates as $document) {
            if (in_array(get_class($document), $classes)) {
                if (method_exists($document, 'getDate')) {
                    $dt = $document->getDate();
                } elseif (method_exists($document, 'getTimestamp' )) {
                    $dt = $document->getTimestamp();
                } else {
                    throw new \Exception('Could not determine DateTime method on class '.get_class($document));
                }

                $date = $dt->format('Y-m-d');
                $cd = $dm->find(null, $chronoPath.'/'.$date);
                if (null === $cd) {
                    $cd = new ChronoDate;
                    $cd->setName($date);
                    $cd->setParent($parent);
                }
                $cd->addDocumentReference($document);
                $dm->persist($cd);
                $uow->computeSingleDocumentChangeSet($cd);
            }
        }

        $removes = $uow->getScheduledRemovals();

        foreach ($removes as $document) {
            if ($document instanceof ChronolizerInterface) {
                $dt = $document->getDate();
                $date = $dt->format('Y-m-d');
                $cd = $dm->find(null, $chronoPath.'/'.$date);
                $referrers = array();
                foreach ($referrers as $route) {
                    $uow->scheduleRemove($route);
                }
            }
        }
    }
}

