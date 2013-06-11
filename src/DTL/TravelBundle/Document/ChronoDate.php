<?php

namespace DTL\TravelBundle\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Cmf\Component\Routing\RouteAwareInterface;
use Doctrine\Common\Collections\Criteria;

class ChronoDate implements RouteAwareInterface
{
    protected $id;

    protected $parent;

    protected $name;

    protected $references;

    protected $routes;

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

    public function getReferences($filter = null)
    {
        if (null === $filter) {
            return $this->references;
        }

        $references = $this->references->filter(function ($document) use ($filter) {
            if (is_subclass_of($document, $filter)) {
                return true;
            }

            return false;
        });

        $array = new ArrayCollection($references->toArray());

        $c = Criteria::create()
            ->orderBy(array(
                'timestamp' => 'ASC',
                'date' => 'ASC',
            ));

        $array = $array->matching($c);

        return $array? : array();
    }

    public function getDate()
    {
        return new \DateTime($this->getName());
    }

    public function getRoutes()
    {
        return $this->routes;
    }
}
