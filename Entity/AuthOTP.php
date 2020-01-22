<?php

namespace AfrikPay\OTPBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use \DateTime;

/**
 * AuthOTP
 *
 * @ORM\Table(name="auth_otp")
 * @ORM\Entity(repositoryClass="AfrikPay\OTPBundle\Repository\AuthOTPRepository")
 */
class AuthOTP
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
     * @ORM\Column(name="mobile", type="string", length=50)
     */
    private $mobile;

     /**
     * @var string
     *
     * @ORM\Column(name="otp", type="string", length=6)
     */
    private $otp;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceOTP", InversedBy="auths", cascade={"persist","remove"})
     * @var ServiceOTP
     */
    private $service;

    /**
     * @ORM\Column(name="createddate", type="datetime", nullable=false)
     * @var DateTime
     */
    private $createddate;


    public function __construct()
    {
       
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
     * Get the value of mobile
     *
     * @return  string
     */ 
    public function getMobile() : string
    {
        return $this->mobile;
    }

    /**
     * Set the value of mobile
     *
     * @param  string  $mobile
     *
     * @return  self
     */ 
    public function setMobile(string $mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get the value of otp
     *
     * @return  string
     */ 
    public function getOtp() : string
    {
        return $this->otp;
    }

    /**
     * Set the value of otp
     *
     * @param  string  $otp
     *
     * @return  self
     */ 
    public function setOtp(string $otp)
    {
        $this->otp = $otp;

        return $this;
    }

    /**
     * Get the value of service
     *
     * @return  ServiceOTP
     */ 
    public function getService() : ?ServiceOTP
    {
        return $this->service;
    }

    /**
     * Set the value of service
     *
     * @param  ServiceOTP  $service
     *
     * @return  self
     */ 
    public function setService(ServiceOTP $service) : self
    {
        $this->service = $service;

        return $this;
    }

    /**
     * Get the value of createddate
     *
     * @return  DateTime
     */ 
    public function getCreateddate()
    {
        return $this->createddate;
    }

    /**
     * Set the value of createddate
     *
     * @param  DateTime  $createddate
     *
     * @return  self
     */ 
    public function setCreateddate(DateTime $createddate)
    {
        $this->createddate = $createddate;

        return $this;
    }
}

?>