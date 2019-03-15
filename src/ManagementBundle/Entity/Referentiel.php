<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Referentiel
 *
 * @ORM\Table(name="referentiel")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\ReferentielRepository")
 */
class Referentiel
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
     * @var \DateTime
     *
     * @ORM\Column(name="creationDate", type="datetime")
     */
    private $creationDate;


    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=255)
     */
    private $code;

    /**
     * @var $yearAcademic
     * @ORM\ManyToOne(targetEntity="ManagementBundle\Entity\AcademicYear", inversedBy="referentiels")
     */
    private $yearAcademic;

    /**
     * @var $level
     * @ORM\ManyToOne(targetEntity="ManagementBundle\Entity\Level", inversedBy="referentiels")
     */
    private $level;

    /**
     * @var $filiere
     * @ORM\ManyToOne(targetEntity="ManagementBundle\Entity\Filiere", inversedBy="referentiels")
     */
    private $filiere;

    /**
     * @var $modules
     * @ORM\ManyToMany(targetEntity="ManagementBundle\Entity\Module")
     */
    private $modules;



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
     * @return Referentiel
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Referentiel
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Set code
     *
     * @param string $code
     *
     * @return Referentiel
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
     * Set yearAcademic
     *
     * @param \ManagementBundle\Entity\AcademicYear $yearAcademic
     *
     * @return Referentiel
     */
    public function setYearAcademic(\ManagementBundle\Entity\AcademicYear $yearAcademic = null)
    {
        $this->yearAcademic = $yearAcademic;

        return $this;
    }

    /**
     * Get yearAcademic
     *
     * @return \ManagementBundle\Entity\AcademicYear
     */
    public function getYearAcademic()
    {
        return $this->yearAcademic;
    }

    /**
     * Set level
     *
     * @param \ManagementBundle\Entity\Level $level
     *
     * @return Referentiel
     */
    public function setLevel(\ManagementBundle\Entity\Level $level = null)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return \ManagementBundle\Entity\Level
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set filiere
     *
     * @param \ManagementBundle\Entity\Filiere $filiere
     *
     * @return Referentiel
     */
    public function setFiliere(\ManagementBundle\Entity\Filiere $filiere = null)
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * Get filiere
     *
     * @return \ManagementBundle\Entity\Filiere
     */
    public function getFiliere()
    {
        return $this->filiere;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->modules = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add module
     *
     * @param \ManagementBundle\Entity\Module $module
     *
     * @return Referentiel
     */
    public function addModule(\ManagementBundle\Entity\Module $module)
    {
        $this->modules[] = $module;

        return $this;
    }

    /**
     * Remove module
     *
     * @param \ManagementBundle\Entity\Module $module
     */
    public function removeModule(\ManagementBundle\Entity\Module $module)
    {
        $this->modules->removeElement($module);
    }

    /**
     * Get modules
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getModules()
    {
        return $this->modules;
    }
}
