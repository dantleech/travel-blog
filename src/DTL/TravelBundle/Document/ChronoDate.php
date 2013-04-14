<?php

namespace DTL\TravelBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;

class ChronoDate
{
    protected $id;

    protected $parent;

    protected $name;

    protected $references;

    public function getId()
    {
        return $this->id;
    }

    public function __construct()
    {
        $this->references = new ArrayCollection;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    public function addDocumentReference($document)
    {
        $this->references[] = $document;
    }

    public function getReferences($filter)
    {
        $references = $this->references->filter(function ($document) use ($filter) {
            if ($document instanceof $filter) {
                return true;
            }

            return false;
        });

        return $references ? : array();
    }
}

