<?php

namespace AfrikPay\OTPBundle\Manager;

use AfrikPay\OTPBundle\Entity\AuthOTP;
use Doctrine\ORM\EntityManagerInterface;

class AuthOTPManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(AuthOTP $AuthOTP)
    {
        $this->entityManager->persist($AuthOTP);
        $this->entityManager->flush();
        return $AuthOTP;
    }

    public function find($ids)
    {
        $AuthOTP = $this->entityManager->getRepository(AuthOTP::class)->find($ids);
        return $AuthOTP;
    }

    public function findOneBy($criteria) : ?AuthOTP
    {
        $AuthOTP = $this->entityManager->getRepository(AuthOTP::class)->findOneBy($criteria);
        return $AuthOTP;
    }

    public function findBy($criteria)
    {
        $AuthOTP = $this->entityManager->getRepository(AuthOTP::class)->findBy($criteria);
        return $AuthOTP;
    }

    public function findAll()
    {
        $AuthOTP = $this->entityManager->getRepository(AuthOTP::class)->findAll();
        return $AuthOTP;
    }

    public function delete($ids)
    {

        $AuthOTP = $this->entityManager->getRepository(AuthOTP::class)->find($ids);
        if ($AuthOTP != null) {
            $this->entityManager->remove($AuthOTP);
            $this->entityManager->flush();
        }
        return $AuthOTP;
    }

}
