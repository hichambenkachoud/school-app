<?php

namespace ManagementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AcademicYear
 *
 * @ORM\Table(name="academic_year")
 * @ORM\Entity(repositoryClass="ManagementBundle\Repository\AcademicYearRepository")
 */
class AcademicYear
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
     * @ORM\Column(name="startDate", type="datetime")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="datetime")
     */
    private $endDate;

    /**
     * @var $referentiels
     * @ORM\OneToMany(targetEntity="ManagementBundle\Entity\Referentiel", mappedBy="yearAcademic")
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
     * @return AcademicYear
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
     * Set startDate
     *
     * @param  $startDate
     *
     * @return $this
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param string $endDate
     *
     * @return AcademicYear
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return string
     */
    public function getEndDate()
    {
        return $this->endDate;
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
     * @return AcademicYear
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
