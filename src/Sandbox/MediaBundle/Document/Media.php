<?php

namespace Sandbox\MediaBundle\Document;

use Sonata\MediaBundle\PHPCR\BaseMedia;
use Doctrine\Common\Collections\ArrayCollection;

class Media extends BaseMedia
{
    /**
     * @var string
     */
    protected $id;

    /**
     * The basepath of the id
     *
     * @var string
     */
    protected $idPrefix;

    protected $longitude;

    protected $latitude;

    protected $altitude;

    protected $date;

    protected $timestamp;

    protected $chronoDates;

    public function __construct()
    {
        $this->chronoDates = new ArrayCollection;
    }


    /**
     * Get id
     *
     * @return string $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the basepath of the id
     *
     * @return string
     */
    public function getIdPrefix()
    {
        return $this->idPrefix;
    }

    /**
     * Set the basepath of the id
     *
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->idPrefix = $prefix;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($v)
    {
        $this->longitude = $v;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($v)
    {
        $this->latitude = $v;
    }

    public function getAltitude()
    {
        return $this->altitude;
    }

    public function setAltitude($v)
    {
        $this->altitude = $v;
    }

    public function setTimestamp(\DateTime $dateTime)
    {
        $this->timestamp = $dateTime;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getChronoDate()
    {
        foreach ($this->chronoDates as $date) {
            if ($date->getName() == $this->getTimestamp()->format('Y-m-d')) {
                return $date;
            }
        }

        return null;
    }

    public function getProviderReference()
    {
        if (!$this->providerReference) {
            return basename($this->getId());
        }
        return $this->providerReference;
    }
}
