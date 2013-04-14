<?php

namespace DTL\TravelBundle\Document;

use Symfony\Cmf\Bundle\BlogBundle\Document\Post as BasePost;

class VoyagePost extends BasePost
{
    protected $distance;

    protected $duration;

    protected $maxSpeed;

    public function getDistance()
    {
        return $this->distance;
    }

    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getMaxSpeed()
    {
        return $this->maxSpeed;
    }

    public function setMaxSpeed($maxSpeed)
    {
        $this->maxSpeed = $maxSpeed;
    }
}
