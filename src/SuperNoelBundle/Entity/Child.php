<?php

namespace SuperNoelBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Children
 *
 * @ORM\Table(name="child")
 * @ORM\Entity(repositoryClass="SuperNoelBundle\Repository\ChildRepository")
 */
class Child
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
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, unique=true)
     */
    private $mail;

    /**
     * @var int
     *
     * @ORM\Column(name="adressnumber", type="integer")
     */
    private $adressnumber;

    /**
     * @var string
     *
     * @ORM\Column(name="adressstreet", type="string", length=255)
     */
    private $adressstreet;

    /**
     * @var string
     *
     * @ORM\Column(name="adresscity", type="string", length=255)
     */
    private $adresscity;

    /**
     * @var string
     *
     * @ORM\Column(name="adresscountry", type="string", length=255)
     */
    private $adresscountry;

    /**
     * @var int
     *
     * @ORM\Column(name="adresspostal", type="integer")
     */
    private $adresspostal;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="wise", type="integer")
     */
    private $wise;

    /**
     * @var bool
     *
     * @ORM\Column(name="delivered", type="boolean")
     */
    private $delivered;


    /**
     * @ORM\OneToMany(targetEntity="Gift", mappedBy="child")
     */
    private $gifts;


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
     * Set firstname
     *
     * @param string $firstname
     *
     * @return Child
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return Child
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Child
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set adressnumber
     *
     * @param integer $adressnumber
     *
     * @return Child
     */
    public function setAdressnumber($adressnumber)
    {
        $this->adressnumber = $adressnumber;

        return $this;
    }

    /**
     * Get adressnumber
     *
     * @return int
     */
    public function getAdressnumber()
    {
        return $this->adressnumber;
    }

    /**
     * Set adressstreet
     *
     * @param string $adressstreet
     *
     * @return Child
     */
    public function setAdressstreet($adressstreet)
    {
        $this->adressstreet = $adressstreet;

        return $this;
    }

    /**
     * Get adressstreet
     *
     * @return string
     */
    public function getAdressstreet()
    {
        return $this->adressstreet;
    }

    /**
     * Set adresscity
     *
     * @param string $adresscity
     *
     * @return Child
     */
    public function setAdresscity($adresscity)
    {
        $this->adresscity = $adresscity;

        return $this;
    }

    /**
     * Get adresscity
     *
     * @return string
     */
    public function getAdresscity()
    {
        return $this->adresscity;
    }

    /**
     * Set adresscountry
     *
     * @param string $adresscountry
     *
     * @return Child
     */
    public function setAdresscountry($adresscountry)
    {
        $this->adresscountry = $adresscountry;

        return $this;
    }

    /**
     * Get adresscountry
     *
     * @return string
     */
    public function getAdresscountry()
    {
        return $this->adresscountry;
    }

    /**
     * Set adresspostal
     *
     * @param integer $adresspostal
     *
     * @return Child
     */
    public function setAdresspostal($adresspostal)
    {
        $this->adresspostal = $adresspostal;

        return $this;
    }

    /**
     * Get adresspostal
     *
     * @return int
     */
    public function getAdresspostal()
    {
        return $this->adresspostal;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Child
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set wise
     *
     * @param integer $wise
     *
     * @return Child
     */
    public function setWise($wise)
    {
        $this->wise = $wise;

        return $this;
    }

    /**
     * Get wise
     *
     * @return int
     */
    public function getWise()
    {
        return $this->wise;
    }

    /**
     * Set delivered
     *
     * @param boolean $delivered
     *
     * @return Child
     */
    public function setDelivered($delivered)
    {
        $this->delivered = $delivered;

        return $this;
    }

    /**
     * Get delivered
     *
     * @return bool
     */
    public function getDelivered()
    {
        return $this->delivered;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gifts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add gift
     *
     * @param \SuperNoelBundle\Entity\Gift $gift
     *
     * @return Child
     */
    public function addGift(\SuperNoelBundle\Entity\Gift $gift)
    {
        $this->gifts[] = $gift;

        return $this;
    }

    /**
     * Remove gift
     *
     * @param \SuperNoelBundle\Entity\Gift $gift
     */
    public function removeGift(\SuperNoelBundle\Entity\Gift $gift)
    {
        $this->gifts->removeElement($gift);
    }

    /**
     * Get gifts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGifts()
    {
        return $this->gifts;
    }
}
