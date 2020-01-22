<?php
namespace AfrikPay\OTPBundle\Service;

use AfrikPay\OTPBundle\Entity\AuthOTP;
use AfrikPay\OTPBundle\Manager\ParamsManager;
use AfrikPay\OTPBundle\Manager\AuthOTPManager;
use AfrikPay\OTPBundle\Manager\ServiceOTPManager;
use AfrikPay\OTPBundle\Exception\GeneralException;
use AfrikPay\OTPBundle\Service\HttpService;
use \DateTime;

class SMSService
{
    /** @var ParamsManager */
    private $params;

    /** @var AuthOTPManager */
    private $authMng;

    /** @var ServiceOTPManager */
    private $serviceMng;

    /** @var HttpService */
    private $http;

    public function __construct(ParamsManager $params,
                                AuthOTPManager $authMng,
                                ServiceOTPManager $serviceMng,
                                HttpService $http)
    {
        $this->params = $params;
        $this->authMng = $authMng;
        $this->serviceMng = $serviceMng;
        $this->http = $http;
    }

    public function sendSMS(string $sender, string $mobile, string $otp)
    {
        $template =  $this->params->get("sms_param_template");
        $message = str_replace("{OTP}", $otp, $template);
        $data = array(
            $this->params->get("sms_param_sender") => $sender,
            $this->params->get("sms_param_mobile") => $mobile,
            $this->params->get("sms_param_message") => $message
        );

        $otherparams = json_decode($this->params->get("sms_other_param"), true);
        array_merge($data, $otherparams);
        $this->http->push($this->params->get("sms_param_endpoint"),$data,$this->params->get("sms_param_method"));
    }

    public function generateOTP(int $length = 6) {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
