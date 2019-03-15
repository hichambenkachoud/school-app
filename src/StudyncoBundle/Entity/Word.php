<?php

namespace StudyncoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Word
 *
 * @ORM\Table(name="word")
 * @ORM\Entity(repositoryClass="StudyncoBundle\Repository\WordRepository")
 */
class Word
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
     * @ORM\Column(name="definition", type="text", nullable=true)
     */
    private $definition;

    /**
     * @var bool
     *
     * @ORM\Column(name="isSynonym", type="boolean")
     */
    private $isSynonym;

    /**
     * @var $synonym
     * @ORM\OneToMany(targetEntity="StudyncoBundle\Entity\Word", mappedBy="parent")
     * @ORM\JoinColumn(name="word_id", referencedColumnName="id")
     */
    private $synonym;

    /**
     * @var $parent
     * @ORM\ManyToOne(targetEntity="StudyncoBundle\Entity\Word")
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
     * @return Word
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
     * Set definition
     *
     * @param string $definition
     *
     * @return Word
     */
    public function setDefinition($definition)
    {
        $this->definition = $definition;

        return $this;
    }

    /**
     * Get definition
     *
     * @return string
     */
    public function getDefinition()
    {
        return $this->definition;
    }

    /**
     * Set isSynonym
     *
     * @param boolean $isSynonym
     *
     * @return Word
     */
    public function setIsSynonym($isSynonym)
    {
        $this->isSynonym = $isSynonym;

        return $this;
    }

    /**
     * Get isSynonym
     *
     * @return bool
     */
    public function getIsSynonym()
    {
        return $this->isSynonym;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->synonym = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Get synonym
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSynonym()
    {
        return $this->synonym;
    }

    /**
     * Add synonym
     *
     * @param \StudyncoBundle\Entity\Word $synonym
     *
     * @return Word
     */
    public function addSynonym(\StudyncoBundle\Entity\Word $synonym)
    {
        $this->synonym[] = $synonym;

        return $this;
    }

    /**
     * Remove synonym
     *
     * @param \StudyncoBundle\Entity\Word $synonym
     */
    public function removeSynonym(\StudyncoBundle\Entity\Word $synonym)
    {
        $this->synonym->removeElement($synonym);
    }

    /**
     * Set parent
     *
     * @param \StudyncoBundle\Entity\Word $parent
     *
     * @return Word
     */
    public function setParent(\StudyncoBundle\Entity\Word $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \StudyncoBundle\Entity\Word
     */
    public function getParent()
    {
        return $this->parent;
    }
}
