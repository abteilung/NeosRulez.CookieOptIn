<?php
namespace NeosRulez\CookieOptIn\Domain\Model;

/*
 * This file is part of the NeosRulez.CookieOptIn package.
 */

use Neos\Flow\Annotations as Flow;
use Doctrine\ORM\Mapping as ORM;

/**
 * @Flow\Entity
 */
class CookieGroup
{

    /**
     * @var string
     */
    protected $name;


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @var string
     */
    protected $description;


    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return void
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @var boolean
     */
    protected $essential;


    /**
     * @return boolean
     */
    public function getEssential()
    {
        return $this->essential;
    }

    /**
     * @param boolean $essential
     * @return void
     */
    public function setEssential($essential)
    {
        $this->essential = $essential;
    }

}
