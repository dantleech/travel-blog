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

        $dm->flush();
    }
}

