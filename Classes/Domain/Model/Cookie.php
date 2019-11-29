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
class Cookie
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
     * @var string
     */
    protected $cookiegroup;


    /**
     * @return string
     */
    public function getCookiegroup()
    {
        return $this->cookiegroup;
    }

    /**
     * @param string $cookiegroup
     * @return void
     */
    public function setCookiegroup($cookiegroup)
    {
        $this->cookiegroup = $cookiegroup;
    }

    /**
     * @var string
     */
    protected $inhead;


    /**
     * @return string
     */
    public function getInhead()
    {
        return $this->inhead;
    }

    /**
     * @param string $inhead
     * @return void
     */
    public function setInhead($inhead)
    {
        $this->inhead = $inhead;
    }

    /**
     * @var string
     */
    protected $infooter;


    /**
     * @return string
     */
    public function getInfooter()
    {
        return $this->infooter;
    }

    /**
     * @param string $infooter
     * @return void
     */
    public function setInfooter($infooter)
    {
        $this->infooter = $infooter;
    }

    /**
     * @var string
     */
    protected $lifetime;


    /**
     * @return string
     */
    public function getLifetime()
    {
        return $this->lifetime;
    }

    /**
     * @param string $lifetime
     * @return void
     */
    public function setLifetime($lifetime)
    {
        $this->lifetime = $lifetime;
    }
    
}
