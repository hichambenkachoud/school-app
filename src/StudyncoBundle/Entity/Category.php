<?php

namespace StudyncoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="StudyncoBundle\Repository\CategoryRepository")
 */
class Category
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
     * @Assert\NotBlank(message="le titre ne doit pas être vide")
     * @Assert\Length(min=3, max=100, minMessage="le titre est courte", maxMessage="le titre est très lent")
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(message="la description ne doit pas être vide")
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="StudyncoBundle\Entity\Field", mappedBy="category", cascade={"persist","remove"})
     * @var $fields
     */
    private $fields;

    /**
     * @var $children
     * @ORM\OneToMany(targetEntity="StudyncoBundle\Entity\Category", mappedBy="parent", cascade={"persist","remove"})
     */
    private $children;

    /**
     * @var $parent
     * @ORM\ManyToOne(targetEntity="StudyncoBundle\Entity\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parent;


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
     * @return Category
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
     * Set description
     *
     * @param string $description
     *
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->fields = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add field
     *
     * @param \StudyncoBundle\Entity\Field $field
     *
     * @return Category
     */
    public function addField(\StudyncoBundle\Entity\Field $field)
    {
        $this->fields[] = $field;

        return $this;
    }

    /**
     * Remove field
     *
     * @param \StudyncoBundle\Entity\Field $field
     */
    public function removeField(\StudyncoBundle\Entity\Field $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * Get fields
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Add child
     *
     * @param \StudyncoBundle\Entity\Category $child
     *
     * @return Category
     */
    public function addChild(\StudyncoBundle\Entity\Category $child)
    {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \StudyncoBundle\Entity\Category $child
     */
    public function removeChild(\StudyncoBundle\Entity\Category $child)
    {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set parent
     *
     * @param \StudyncoBundle\Entity\Category $parent
     *
     * @return Category
     */
    public function setParent(\StudyncoBundle\Entity\Category $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \StudyncoBundle\Entity\Category
     */
    public function getParent()
    {
        return $this->parent;
    }
}
