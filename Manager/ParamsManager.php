<?php

namespace AfrikPay\OTPBundle\Manager;

use AfrikPay\OTPBundle\Entity\Params;
use AfrikPay\OTPBundle\Exception\GeneralException;
use Doctrine\ORM\EntityManagerInterface;

class ParamsManager
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function save(Params $Params)
    {
        $this->entityManager->persist($Params);
        $this->entityManager->flush();
        return $Params;
    }

    public function find($ids) : Params
    {
        $Params = $this->entityManager->getRepository(Params::class)->find($ids);
        return $Params;
    }

    public function get($key) : string
    {
        $criteria = array("cle" => $key);
        $params = $this->entityManager->getRepository(Params::class)->findOneBy($criteria);
        if($params == null){
            throw new GeneralException(400, "Parameter " . $key . " Not configured");
        }
        return $params->getValue();
    }

    public function findOneBy($criteria) : ?Params
    {
        $Params = $this->entityManager->getRepository(Params::class)->findOneBy($criteria);
        return $Params;
    }

    public function findBy($criteria)
    {
        $Params = $this->entityManager->getRepository(Params::class)->findBy($criteria);
        return $Params;
    }

    public function delete($ids)
    {

        $Params = $this->entityManager->getRepository(Params::class)->find($ids);
        if ($Params != null) {
            $this->entityManager->remove($Params);
            $this->entityManager->flush();
        }
        return $Params;
    }

}
