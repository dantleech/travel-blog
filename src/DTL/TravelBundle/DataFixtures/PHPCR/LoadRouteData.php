<?php

namespace DTL\MainBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\RoutingExtraBundle\Document\Route;
use PHPCR\Util\NodeHelper;

class LoadRouteData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 30;
    }

    public function load(ObjectManager $dm)
    {
        $session = $dm->getPhpcrSession();

        $root = $dm->find(null, '/cms/routes');
        $content = $dm->find(null, '/cms/content/home');

        $route = new Route;
        $route->setName('home');
        $route->setRouteContent($content);
        $route->setParent($root);

        $dm->persist($route);
        $dm->flush();
    }
}

