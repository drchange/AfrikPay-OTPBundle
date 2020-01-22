<?php

namespace AfrikPay\OTPBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use \Datetime;
use AfrikPay\OTPBundle\Exception\GeneralException;
use AfrikPay\OTPBundle\Model\Result;
use AfrikPay\OTPBundle\Service\OTPService;


class ConfirmationOTPController extends AbstractController
{
    /**
     * @Rest\Post("/otp/api/confirmation")
     * @Rest\View
     * 
     * @SWG\Response(
     *     response=200,
     *     description="Returns the result"
     * )
     * @SWG\Parameter(
     *     name="mobile",
     *     in="formData",
     *     type="string",
     *     description="Mobile"
     * )
     * 
     * @SWG\Parameter(
     *     name="service",
     *     in="formData",
     *     type="string",
     *     description="Service"
     * )
     * 
     * @SWG\Parameter(
     *     name="otp",
     *     in="formData",
     *     type="string",
     *     description="OTP"
     * )
     * 
     */
    public function confirmation(Request $request, OTPService $otpService)
    {
        try{
            $mobile = $request->get("mobile");
            $service = $request->get("service");
            $otp = $request->get("otp");
            $result = $otpService->confirmOTP($service, $mobile,$otp);
            $response = new Result(200, "Success", $result);
            $data = $this->get('serializer')->serialize($response, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }catch(GeneralException $e){
            $response = new Result($e->getCode(), $e->getMessage(), null);
            $data = $this->get('serializer')->serialize($response, 'json');
            $response = new Response($data);
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        }
        
    }
}
