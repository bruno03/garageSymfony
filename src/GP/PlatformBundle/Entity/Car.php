<?php

namespace GP\PlatformBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ca
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Car
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
   * @ORM\JoinColumn(nullable=false, onDelete="CASCADE")
   */
	private $customer; 
	

    /**
     * @var string
     *
     * @ORM\Column(name="mark", type="string", length=255)
     */
    private $mark;

    /**
     * @var string
     *
     * @ORM\Column(name="model", type="string", length=255)
     */
    private $model;
	
	/**
     * @var string
     *
     * @ORM\Column(name="plate", type="string", length=255)
     */
    private $plate;

    /**
     * @var string
     *
     * @ORM\Column(name="year", type="string", length=255)
     */
    private $year;


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
     * Set mark
     *
     * @param string $mark
     * @return Ca
     */
    public function setMark($mark)
    {
        $this->mark = $mark;
    
        return $this;
    }

    /**
     * Get mark
     *
     * @return string 
     */
    public function getMark()
    {
        return $this->mark;
    }

    /**
     * Set model
     *
     * @param string $model
     * @return Ca
     */
    public function setModel($model)
    {
        $this->model = $model;
    
        return $this;
    }

    /**
     * Get model
     *
     * @return string 
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Set year
     *
     * @param string $year
     * @return Ca
     */
    public function setYear($year)
    {
        $this->year = $year;
    
        return $this;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set customer
     *
     * @param \GP\PlatformBundle\Entity\Customer $customer
     * @return Car
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
     * Set plate
     *
     * @param string $plate
     * @return Car
     */
    public function setPlate($plate)
    {
        $this->plate = $plate;
    
        return $this;
    }

    /**
     * Get plate
     *
     * @return string 
     */
    public function getPlate()
    {
        return $this->plate;
    }
}
