<?php

namespace DTL\MainBundle\DataFixtures\PHPCR;

use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Cmf\Bundle\BlogBundle\Document\Blog;
use DTL\TravelBundle\Document\VoyagePost;
use PHPCR\Util\NodeHelper;

class LoadBlogData implements FixtureInterface, OrderedFixtureInterface
{
    public function getOrder()
    {
        return 10;
    }

    public function load(ObjectManager $dm)
    {
        $session = $dm->getPhpcrSession();

        NodeHelper::createPath($session, '/cms/content');
        NodeHelper::createPath($session, '/cms/routes');

        $root = $dm->find(null, '/cms/content');

        $this->faker = \Faker\Factory::create();

        $blog = new Blog;
        $blog->setName('DTLs Blog');
        $blog->setParent($root);
        $dm->persist($blog);

        $static = array(
            '2013-01-01' => 'Weymouth to Portsmouth',
            '2013-01-02' => 'Ouistreham to Alençon',
            '2013-01-03' => 'Alençon to Somewhere',
            '2013-01-04' => 'Somewhere Else to Here',
            '2013-01-05' => 'Another day on the road',
            '2013-01-06' => 'With Jack Karoak',
            '2013-01-07' => 'Youth Hostels',
            '2013-01-08' => 'Expensive Hotels',
            '2013-01-09' => 'Theft of Bicycle',
            '2013-01-10' => 'Leaving Portugal',
            '2013-01-11' => 'When will my Credit Card get here?',
            '2013-01-12' => 'Sitting in the salon',
            '2013-01-13' => 'One week in Lagos',
            '2013-01-14' => 'Writing lots of code for the CMF',
            '2013-01-15' => 'And working on my travel blog',
            '2013-01-16' => 'Next project is to get a Taxonomy bundle in CMF',
            '2013-01-17' => 'and maybe some OpenStreetMaps bundle for the travel blog',
            '2013-01-18' => 'Nice that camera photos have GPS coordinates.',
            '2013-01-19' => 'The sun is shining',
            '2013-01-20' => 'And breakfast is always good.',
        );

        foreach ($static as $date => $title) {
            $p = new VoyagePost;
            $p->setTitle($title);
            $p->setDate(new \DateTime($date));
            $p->setBody($this->faker->text(500));
            $p->setBlog($blog);
            $p->setDistance($dist = rand(33, 160) * 1000);
            $p->setDuration((($dist / 1000) / rand(14, 30) * 3600));
            $p->setMaxSpeed(rand(33, 60));
            $dm->persist($p);
        }

        $dm->flush();
    }
}
