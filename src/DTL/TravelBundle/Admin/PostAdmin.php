<?php

namespace DTL\TravelBundle\Admin;

use Symfony\Cmf\Bundle\BlogBundle\Admin\PostAdmin as BasePostAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class PostAdmin extends BasePostAdmin
{
    protected function configureFormFields(FormMapper $mapper)
    {
        parent::configureFormFields($mapper);
        $mapper->add('distance', 'distance');
        $mapper->add('duration', 'stopwatch');
        $mapper->add('maxSpeed', 'number');
    }
}
