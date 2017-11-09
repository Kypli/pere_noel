<?php

namespace SuperNoelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Gift
 *
 * @ORM\Table(name="gift")
 * @ORM\Entity(repositoryClass="SuperNoelBundle\Repository\GiftRepository")
 */
class Gift
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="feasibility", type="integer", nullable=true)
     */
    private $feasibility;

    /**
     * @var bool
     *
     * @ORM\Column(name="treated", type="boolean")
     */
    private $treated;


    /**
     * @ORM\OneToOne(targetEntity="SuperNoelBundle\Entity\Category")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="Child", inversedBy="gifts")
     */
    private $child;

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
     * Set name
     *
     * @param string $name
     *
     * @return Gift
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

        /**
     * Set feasibility
     *
     * @param integer $feasibility
     *
     * @return Gift
     */
    public function setFeasibility($feasibility)
    {
        $this->feasibility = $feasibility;

        return $this;
    }

    /**
     * Get feasibility
     *
     * @return int
     */
    public function getFeasibility()
    {
        return $this->feasibility;
    }

    /**
     * Set treated
     *
     * @param boolean $treated
     *
     * @return Gift
     */
    public function setTreated($treated)
    {
        $this->treated = $treated;

        return $this;
    }

    /**
     * Get treated
     *
     * @return bool
     */
    public function getTreated()
    {
        return $this->treated;
    }

    /**
     * Set category
     *
     * @param \SuperNoelBundle\Entity\Category $category
     *
     * @return Gift
     */
    public function setCategory(\SuperNoelBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \SuperNoelBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set child
     *
     * @param \SuperNoelBundle\Entity\Child $child
     *
     * @return Gift
     */
    public function setChild(\SuperNoelBundle\Entity\Child $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return \SuperNoelBundle\Entity\Child
     */
    public function getChild()
    {
        return $this->child;
    }
}
