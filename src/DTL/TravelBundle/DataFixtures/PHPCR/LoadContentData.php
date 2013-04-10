<?php

namespace DTL\MainBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\ContentBundle\Document\StaticContent;
use PHPCR\Util\NodeHelper;

class LoadContentData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 20;
    }

    public function load(ObjectManager $dm)
    {
        $session = $dm->getPhpcrSession();

        $root = $dm->find(null, '/cms/content');

        $home = new StaticContent;
        $home->setName('home');
        $home->setTitle('Home');
        $home->setBody(<<<HEREDOC
Welcome to my blog!
HEREDOC
        );
        $home->setParent($root);

        $dm->persist($home);
        $dm->flush();
    }
}

