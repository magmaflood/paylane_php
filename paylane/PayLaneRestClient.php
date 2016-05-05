<?php

class PayLaneRestClient
{

    protected $api_url = 'https://direct.paylane.com/rest/';

    protected $username = null, $password = null;

    protected $http_errors = array
    (
        400 => '400 Bad Request',
        401 => '401 Unauthorized',
        500 => '500 Internal Server Error',
        501 => '501 Not Implemented',
        502 => '502 Bad Gateway',
        503 => '503 Service Unavailable',
        504 => '504 Gateway Timeout',
    );
    
    protected $is_success = false;

    protected $allowed_request_methods = array(
        'get',
        'put',
        'post',
        'delete',
    );

    protected $ssl_verify = true;
    
    /**
     * @param string $username Username
     * @param string $password Password
     */
    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        
        $validate_params = array
        (
            false === extension_loaded('curl') => 'The curl extension must be loaded for using this class!',
            false === extension_loaded('json') => 'The json extension must be loaded for using this class!'
        );
        $this->checkForErrors($validate_params);
    }

    public function setUrl($url)
    {
        $this->api_url = $url;
    }
    

    public function setSSLverify($ssl_verify)
    {
        $this->ssl_verify = $ssl_verify;
    }
    

    public function isSuccess()
    {
        return $this->is_success;
    }

    public function cardSale($params)
    {
        return $this->call(
            'cards/sale',
            'post',
             $params
        );
    }

    public function cardSaleByToken($params)
    {
        return $this->call(
            'cards/saleByToken',
            'post',
             $params
        );
    }

    public function cardAuthorization($params)
    {
        return $this->call(
            'cards/authorization',
            'post',
            $params
        );
    }

    public function cardAuthorizationByToken($params)
    {
        return $this->call(
            'cards/authorizationByToken',
            'post',
            $params
        );
    }
    

    public function paypalAuthorization($params)
    {
        return $this->call(
            'paypal/authorization',
            'post',
            $params
        );
    }

    public function captureAuthorization($params)
    {
        return $this->call(
            'authorizations/capture',
            'post',
            $params
        );
    }

    public function closeAuthorization($params)
    {
        return $this->call(
            'authorizations/close',
            'post',
            $params
        );
    }

    public function refund($params)
    {
        return $this->call(
            'refunds',
            'post',
            $params
        );
    }
    /**
     * Get sale info
     *
     * @param array $params Get sale info params
     * @return array
     */
    public function getSaleInfo($params)
    {
        return $this->call(
            'sales/info',
            'get',
            $params
        );
    }
    

    public function getAuthorizationInfo($params)
    {
        return $this->call(
            'authorizations/info',
            'get',
            $params
        );
    }

    public function checkSaleStatus($params)
    {
        return $this->call(
            'sales/status',
            'get',
            $params
        );
    }

    public function directDebitSale($params)
    {
        return $this->call(
            'directdebits/sale',
            'post',
            $params
        );
    }

    public function sofortSale($params)
    {
        return $this->call(
            'sofort/sale',
            'post',
            $params
        );
    }

    public function idealSale($params)
    {
        return $this->call(
            'ideal/sale',
            'post',
            $params
        );
    }

	public function idealBankCodes()
    {
        return $this->call(
            'ideal/bankcodes',
            'get',
            array()
        );
    }

    public function bankTransferSale($params)
    {
        return $this->call(
            'banktransfers/sale',
            'post',
            $params
        );
    }
    

    public function paypalSale($params)
    {
        return $this->call(
            'paypal/sale',
            'post',
            $params
        );
    }

    public function paypalStopRecurring($params)
    {
        return $this->call('paypal/stopRecurring',
            'post',
            $params
        );
    }
    /**
     *  Performs resale by sale ID
     *
     * @param array $params Resale by sale params
     * @return array
     */
    public function resaleBySale($params)
    {
        return $this->call(
            'resales/sale',
            'post',
            $params
        );
    }

    public function resaleByAuthorization($params)
    {
        return $this->call(
            'resales/authorization',
            'post',
            $params
        );
    }

    public function checkCard3DSecure($params)
    {
        return $this->call(
            '3DSecure/checkCard',
            'get',
            $params
        );
    }

    public function checkCard3DSecureByToken($params)
    {
        return $this->call(
            '3DSecure/checkCardByToken',
            'get',
            $params
        );
    }

    public function saleBy3DSecureAuthorization($params)
    {
        return $this->call(
            '3DSecure/authSale',
            'post',
            $params
        );
    }

    public function checkCard($params)
    {
        return $this->call(
            'cards/check',
            'get',
            $params
        );
    }
    

    public function checkCardByToken($params)
    {
        return $this->call(
            'cards/checkByToken',
            'get',
            $params
        );
    }

    protected function call($method, $request, $params)
    {
        $this->is_success = false;
        if (is_object($params))
        {
            $params = (array) $params;
        }
        
        $validate_params = array
        (
            false === is_string($method) => 'Method name must be string',
            false === $this->checkRequestMethod($request) => 'Not allowed request method type',
        );
        $this->checkForErrors($validate_params);
        $params_encoded = json_encode($params);
        
        $response = $this->pushData($method, $request, $params_encoded);
        $response = json_decode($response, true);
        if (isset($response['success']) && $response['success'] === true)
        {
            $this->is_success = true;
        }
        return $response;
    }

    protected function checkForErrors($validate_params)
    {
        foreach ($validate_params as $key => $error)
        {
            if ($key)
            {
                throw new \Exception($error);
            }
        }
    }

    protected function checkRequestMethod($method_type)
    {
        $request_method = strtolower($method_type);
        if(in_array($request_method, $this->allowed_request_methods))
        {
            return true;
        }
        return false;
    }

    protected function pushData($method, $method_type, $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->api_url . $method);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, strtoupper($method_type));
        curl_setopt($ch, CURLOPT_HTTPAUTH, 1);
        curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, $this->ssl_verify);
        
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (isset($this->http_errors[$http_code]))
        {
            throw new \Exception('Response Http Error - ' . $this->http_errors[$http_code]);
        }
        if (0 < curl_errno($ch))
        {
            throw new \Exception('Unable to connect to ' . $this->api_url . ' Error: ' . curl_error($ch));
        }
        curl_close($ch);
        
        return $response;
    }
}
