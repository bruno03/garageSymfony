<?php

namespace GP\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Bill
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Bill
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
	
	/**
     * @ORM\ManyToOne(targetEntity="GP\PlatformBundle\Entity\Customer")
     * @ORM\JoinColumn(nullable=false)
     */
    private $customer; 
	
	/**
     * @ORM\ManyToOne(targetEntity="GP\PlatformBundle\Entity\Car")
     * @ORM\JoinColumn(nullable=false)
     */
    private $car; 

    /**
     * @var integer
     *
     * @ORM\Column(name="kms", type="integer")
     */
    private $kms;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set kms
     *
     * @param integer $kms
     * @return Bill
     */
    public function setKms($kms)
    {
        $this->kms = $kms;
    
        return $this;
    }

    /**
     * Get kms
     *
     * @return integer 
     */
    public function getKms()
    {
        return $this->kms;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Bill
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set price
     *
     * @param integer $price
     * @return Bill
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return integer 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set customer
     *
     * @param \GP\PlatformBundle\Entity\Customer $customer
     * @return Bill
     */
    public function setCustomer(\GP\PlatformBundle\Entity\Customer $customer)
    {
        $this->customer = $customer;
    
        return $this;
    }

    /**
     * Get customer
     *
     * @return \GP\PlatformBundle\Entity\Customer 
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * Set car
     *
     * @param \GP\PlatformBundle\Entity\Car $car
     * @return Bill
     */
    public function setCar(\GP\PlatformBundle\Entity\Car $car)
    {
        $this->car = $car;
    
        return $this;
    }

    /**
     * Get car
     *
     * @return \GP\PlatformBundle\Entity\Car 
     */
    public function getCar()
    {
        return $this->car;
    }
}
