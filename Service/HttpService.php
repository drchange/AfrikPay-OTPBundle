<?php

namespace AfrikPay\OTPBundle\Service;

use Symfony\Component\HttpClient\CurlHttpClient;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;



/* @class service curl http service */
class HttpService
{

    public function push(string $url, $data, string $method = 'GET', $type = 'json') : string
    {
        return $this->{"send$method"}($url, $data, $type);
    }
    
    public function sendGET(string $url, $data) : string
    {
        $httpClient = new CurlHttpClient();
        $response = $httpClient->request('GET', $url, [
            'query' => $data
        ]);
        return $response->getContent();
    }
    
    // type = "json/xml/raw data"
    public function sendPOST(string $url, $data, $type = 'json', $headers = null) : string
    {
        $httpClient = new CurlHttpClient();
        $response = "";
        $timeout = 1000;
        
        if ($type === 'json') {
            $response = $httpClient->request('POST', $url, [
                $type => $data,
                'headers' => $headers,
                'timeout' => $timeout
            ]);
        } elseif (true) {
            $bodyparam = $dataparam = 'body';
            $response = $httpClient->request('POST', $url, [
                $bodyparam => $type,
                $dataparam => $data,
                'headers' => $headers,
                'timeout' => $timeout
            ]);
        }
        

        return $response->getContent();
    }

     // type = "json/xml/raw data"
     public function asyncPOST(string $url, $data, $type = 'json', $headers = null) : void
     {
         try{
            $httpClient = new CurlHttpClient();
            $timeout = 1;
             if ($type === 'json') {
                 $httpClient->request('POST', $url, [
                     $type => $data,
                     'headers' => $headers,
                     'timeout' => $timeout
                 ]);
             } elseif (true) {
                 $bodyparam = $dataparam = 'body';
                 $httpClient->request('POST', $url, [
                     $bodyparam => $type,
                     $dataparam => $data,
                     'headers' => $headers,
                     'timeout' => $timeout
                 ]);
             }

         }catch(TransportExceptionInterface $e){
            //throw new AccountException(500 , $e->getMessage());
         }
     }

     public function sendNativeGET($url, $data)
    {
        $url = $url ."?". http_build_query($data);
        $req = curl_init($url);        
        curl_setopt($req, CURLOPT_FOLLOWLOCATION, 1); //FOLLOW TO CHANGE LOCATION
        curl_setopt($req, CURLOPT_URL, $url);
        curl_setopt($req, CURLOPT_HEADER, 0);
        curl_setopt($req, CURLOPT_TIMEOUT, 1000000000);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($req);
        curl_close($req);
        return $response;
    }
    

    public function send($url, $data)
    {
        $req = curl_init($url);
        curl_setopt($req, CURLOPT_FOLLOWLOCATION, 1); //FOLLOW TO CHANGE LOCATION
        curl_setopt($req, CURLOPT_URL, $url);
        curl_setopt($req, CURLOPT_HEADER, 0);
        curl_setopt($req, CURLOPT_POST, 1);
        curl_setopt($req, CURLOPT_TIMEOUT, 1000000000);
        curl_setopt($req, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($req, CURLOPT_POSTFIELDS, $data);
        curl_setopt($req, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($req, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($req);
        curl_close($req);
        return $response;
    }

}
