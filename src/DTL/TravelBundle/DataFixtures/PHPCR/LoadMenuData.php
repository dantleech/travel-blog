<?php

namespace DTL\MainBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\MenuBundle\Document\MenuNode;
use PHPCR\Util\NodeHelper;

class LoadMenuData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 40;
    }

    public function load(ObjectManager $dm)
    {
        $session = $dm->getPhpcrSession();

        NodeHelper::createPath($session, '/cms/menu');

        $root = $dm->find(null, '/cms/menu');
        $homeContent = $dm->find(null, '/cms/content/home');
        $blogContent = $dm->find(null, '/cms/content/DTLs Blog');
        $chronoRoute = $dm->find(null, '/cms/routes/chronology');
        $mapRoute = $dm->find(null, '/cms/routes/map');

        $menu = new MenuNode;
        $menu->setName('main');
        $menu->setParent($root);
        $menu->setContent($homeContent);
        $dm->persist($menu);

        $menuNode = new MenuNode;
        $menuNode->setName('home');
        $menuNode->setParent($menu);
        $menuNode->setContent($homeContent);
        $menuNode->setLabel('Home');
        $dm->persist($menuNode);

        $menuNode = new MenuNode;
        $menuNode->setName('blog');
        $menuNode->setParent($menu);
        $menuNode->setContent($blogContent);
        $menuNode->setLabel('Blog');
        $dm->persist($menuNode);

        $chronologyNode = new MenuNode;
        $chronologyNode->setName('chronology');
        $chronologyNode->setParent($menu);
        $chronologyNode->setContent($chronoRoute);
        $chronologyNode->setLabel('Timeline');
        $dm->persist($chronologyNode);

        $mapNode = new MenuNode;
        $mapNode->setName('map');
        $mapNode->setParent($menu);
        $mapNode->setContent($mapRoute);
        $mapNode->setLabel('Map');
        $dm->persist($mapNode);

        $dm->flush();
    }
}

