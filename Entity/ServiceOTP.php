<?php

namespace AfrikPay\OTPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * ServiceOTP
 *
 * @ORM\Table(name="service_otp")
 * @ORM\Entity(repositoryClass="AfrikPay\OTPBundle\Repository\ServiceOTPRepository")
 */
class ServiceOTP
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=50)
     */
    private $slug;

    /**
     * @var boolean
     *
     * @ORM\Column(name="status", type="boolean")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="AuthOTP", mappedBy="service", cascade={"persist","remove"})
     * @var ArrayCollection
     */
    protected $auths;


    public function __construct()
    {
        $this->auths = new ArrayCollection();
    }

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
     * Set name
     *
     * @param  string  $name
     * @return ServiceOTP
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
     * Get the value of status
     *
     * @return  bool
     */ 
    public function getStatus() : bool
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @param  bool  $status
     *
     * @return  self
     */ 
    public function setStatus(bool $status) : self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of auths
     *
     * @return  ArrayCollection
     */ 
    public function getAuths()
    {
        return $this->auths;
    }

    /**
     * Set the value of auths
     *
     * @param  ArrayCollection  $auths
     *
     * @return  self
     */ 
    public function setAuths(ArrayCollection $auths)
    {
        $this->auths = $auths;

        return $this;
    }

    /**
     * Get the value of slug
     *
     * @return  string
     */ 
    public function getSlug() : string
    {
        return $this->slug;
    }

    /**
     * Set the value of slug
     *
     * @param  string  $slug
     *
     * @return  self
     */ 
    public function setSlug(string $slug) : self
    {
        $this->slug = $slug;

        return $this;
    }
}

?>