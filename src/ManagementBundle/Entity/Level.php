<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Level
 *
 * @ORM\Table(name="level")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\LevelRepository")
 */
class Level
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;


    /**
     * @var $referentiels
     * @ORM\OneToMany(targetEntity="ManagementBundle\Entity\Referentiel", mappedBy="level")
     */
    private $referentiels;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Level
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Level
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->referentiels = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add referentiel
     *
     * @param \ManagementBundle\Entity\Referentiel $referentiel
     *
     * @return Level
     */
    public function addReferentiel(\ManagementBundle\Entity\Referentiel $referentiel)
    {
        $this->referentiels[] = $referentiel;

        return $this;
    }

    /**
     * Remove referentiel
     *
     * @param \ManagementBundle\Entity\Referentiel $referentiel
     */
    public function removeReferentiel(\ManagementBundle\Entity\Referentiel $referentiel)
    {
        $this->referentiels->removeElement($referentiel);
    }

    /**
     * Get referentiels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getReferentiels()
    {
        return $this->referentiels;
    }
}
