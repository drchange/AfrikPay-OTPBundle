<?php

namespace AfrikPay\OTPBundle\Exception;

use \Exception;

class GeneralException extends Exception
{
    /* @var exception code */
    public $code = 500;

    /* @var exception message */
    public $message = "General Error";

    public function __construct($code, $message)
    {
        $this->code = $code;

        $this->message = $message;
    }
    
}
