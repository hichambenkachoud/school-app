<?php

namespace UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Student
 *
 * @ORM\Table(name="student")
 * @ORM\Entity(repositoryClass="UserBundle\Repository\StudentRepository")
 */
class Student extends User
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


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
     * @var string
     * @ORM\Column(name="code", type="string", length=255)
     */
    protected $code;

    /**
     * @var \DateTime
     * @ORM\Column(name="datecreation",type="datetime")
     */
    protected $dateCreation;

    /**
     * Get code
     *
     * @return string
     */
    public function getCode(){
        return $this->code;
    }

    /**
     * @param $code
     * @return $this
     */
    public function setCode($code)
    {
        $this->code = $code;
        return $this;
    }

    /**
     * @param $dateCreation
     * @return $this
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set image
     *
     * @param \DashboardBundle\Entity\Image $image
     *
     * @return Student
     */
    public function setImage(\DashboardBundle\Entity\Image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \DashboardBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }
}
