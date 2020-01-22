<?php
namespace AfrikPay\OTPBundle\Service;

use AfrikPay\OTPBundle\Entity\AuthOTP;
use AfrikPay\OTPBundle\Manager\ParamsManager;
use AfrikPay\OTPBundle\Manager\AuthOTPManager;
use AfrikPay\OTPBundle\Manager\ServiceOTPManager;
use AfrikPay\OTPBundle\Exception\GeneralException;
use AfrikPay\OTPBundle\Service\SMSService;
use \DateTime;

class OTPService
{
    /** @var ParamsManager */
    private $params;

    /** @var AuthOTPManager */
    private $authMng;

    /** @var ServiceOTPManager */
    private $serviceMng;

    /** @var SMSService */
    private $smsService;

    public function __construct(ParamsManager $params,
                                AuthOTPManager $authMng,
                                ServiceOTPManager $serviceMng,
                                SMSService $smsService)
    {
        $this->params = $params;
        $this->authMng = $authMng;
        $this->serviceMng = $serviceMng;
        $this->smsService = $smsService;
    }

    public function isValid(AuthOtp $auth) : bool
    {
        $now = new DateTime();
        $diff = abs($auth->getCreateddate()->getTimestamp() - $now->getTimestamp()) / 60 ;
        if ($diff > floatval($this->params->get("otp_validity"))){
            return false;
        }
        return true;
    }

    public function sendOTP(AuthOtp $auth){
        $this->smsService->sendSMS($auth->getService()->getName(), $auth->getMobile(), $auth->getOtp());
    }


    public function confirmOTP(string $service, string $mobile, string $otp) : AuthOTP
    {
        // find previous request
        $criteria = array("service" => $service, "mobile" => $mobile, "otp" => $otp);
        $auth = $this->authMng->findOneBy($criteria);
        if($auth != null){
            $this->authMng->delete($auth->getId());
        }
        return $auth;
    }

    public function requestOTP(string $service, string $mobile) : AuthOTP
    {
        //find Service
        $criteria = array("slug" => $service);
        $service = $this->serviceMng->findOneBy($criteria);
        if($service == null){
            throw new GeneralException(500, "service not found");
        }

        // find previous request
        $criteria = array("service" => $service, "mobile" => $mobile);
        $auth = $this->authMng->findOneBy($criteria);
        if($auth != null){
            $now = new DateTime();
            $diff = abs($auth->getCreateddate()->getTimestamp() - $now->getTimestamp()) / 60 ;
            if(!$this->isValid($auth)){
                $this->authMng->delete($auth->getId());
            }
        }
        $auth = new AuthOTP();
        $auth->setService($service);
        $auth->setMobile($mobile);
        $auth->setCreateddate(new DateTime());
        $length = intval($this->params->get("otp_length"));
        $otp = $this->smsService->generateOTP($length);
        $auth->setOtp($otp);
        $auth = $this->authMng->save($auth);
        return $auth;
    }
}
