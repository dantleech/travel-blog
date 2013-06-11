<?php

namespace DTL\TravelBundle\Document;

use Symfony\Cmf\Bundle\BlogBundle\Document\Post as BasePost;
use Doctrine\Common\Collections\ArrayCollection;

class VoyagePost extends BasePost
{
    protected $distance;

    protected $duration;

    protected $maxSpeed;

    protected $chronoDates;

    public function __construct()
    {
        $this->chronoDates = new ArrayCollection;
    }

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

    public function getChronoDate()
    {
        foreach ($this->chronoDates as $date) {
            if ($date->getName() == $this->getDate()->format('Y-m-d')) {
                return $date;
            }
        }

        return null;
    }

    public function getWordCount()
    {
        return str_word_count($this->body);
    }
}
