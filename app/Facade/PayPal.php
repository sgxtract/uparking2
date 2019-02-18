<?php

namespace App\Facade;

use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;

class PayPal{
    public static function apiContext(){
        date_default_timezone_set(@date_default_timezone_get());

        error_reporting(E_ALL);
        ini_set('display_errors', '1');

        $clientId = 'AcnF5zqvB1JtZr28XgPhDKbeXgHLc-Y_5HIfAsTe5GXpOnzb3_r0lgQDaD_-6Ua7zHdIJ464smtasxrJ';
        $clientSecret = 'EEGTTgbWkHMjTVCm13aZ6Qqq3L0lTBGjcNmbeeUt14kxrsKZ-hZcCFgtqEDuijBjiHaNZ-YAvLk5XRsP';

        $apiContext = self::getApiContext($clientId, $clientSecret);

        return $apiContext;
    }

    public static function getApiContext($clientId, $clientSecret){

        $apiContext = new ApiContext(
            new OAuthTokenCredential(
                $clientId,
                $clientSecret
            )
        );

        $apiContext->setConfig(
            array(
                'mode' => 'sandbox',
                'log.LogEnabled' => true,
                'log.FileName' => '../PayPal.log',
                'log.LogLevel' => 'DEBUG', // PLEASE USE `INFO` LEVEL FOR LOGGING IN LIVE ENVIRONMENTS
                'cache.enabled' => true,
                //'cache.FileName' => '/PaypalCache' // for determining paypal cache directory
                // 'http.CURLOPT_CONNECTTIMEOUT' => 30
                // 'http.headers.PayPal-Partner-Attribution-Id' => '123123123'
                //'log.AdapterFactory' => '\PayPal\Log\DefaultLogFactory' // Factory class implementing \PayPal\Log\PayPalLogFactory
            )
        );

        return $apiContext;
    }
}