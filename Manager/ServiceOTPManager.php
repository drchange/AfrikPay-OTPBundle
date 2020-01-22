<?php

namespace AfrikPay\OTPBundle\Manager;

use AfrikPay\OTPBundle\Entity\ServiceOTP;
use Doctrine\ORM\EntityManagerInterface;

class ServiceOTPManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(ServiceOTP $ServiceOTP)
    {
        $this->entityManager->persist($ServiceOTP);
        $this->entityManager->flush();
        return $ServiceOTP;
    }

    public function find($ids)
    {
        $ServiceOTP = $this->entityManager->getRepository(ServiceOTP::class)->find($ids);
        return $ServiceOTP;
    }

    public function findOneBy($criteria) : ?ServiceOTP
    {
        $ServiceOTP = $this->entityManager->getRepository(ServiceOTP::class)->findOneBy($criteria);
        return $ServiceOTP;
    }

    public function findBy($criteria)
    {
        $ServiceOTP = $this->entityManager->getRepository(ServiceOTP::class)->findBy($criteria);
        return $ServiceOTP;
    }

    public function findAll()
    {
        $ServiceOTP = $this->entityManager->getRepository(ServiceOTP::class)->findAll();
        return $ServiceOTP;
    }

    public function delete($ids)
    {

        $ServiceOTP = $this->entityManager->getRepository(ServiceOTP::class)->find($ids);
        if ($ServiceOTP != null) {
            $this->entityManager->remove($ServiceOTP);
            $this->entityManager->flush();
        }
        return $ServiceOTP;
    }

}
