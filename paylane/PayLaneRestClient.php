 <?php
 
/**
 * Client library for Paylane REST Server.
 * More info at http://devzone.paylane.com
 */
 class PayLaneRestClient
 {
    /**
     * @var string
     */

     protected $api_url = 'https://direct.paylane.com/rest/';
 
    /**
     * @var string
     */
     protected $username = null, $password = null;
 
    /**
     * @var array
     */
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

    /**
     * @var bool
     */
    
     protected $is_success = false;
 
    /**
     * @var array
     */
     protected $allowed_request_methods = array(
         'get',
         'put',
         'post',
         'delete',
     );
 
    /**
     * @var boolean
     */
     protected $ssl_verify = true;
     
     /**
     * Constructor
     * 
      * @param string $username Username
      * @param string $password Password
      */
	public function __construct($username, $password)
         $this->checkForErrors($validate_params);
     }
 
    /**
     * Set Api URL
     * 
     * @param string $url Api URL
     */
     public function setUrl($url)
     {
         $this->api_url = $url;
     }
     
    /**
     * Sets SSL verify
     * 
     * @param bool $ssl_verify SSL verify
     */

     public function setSSLverify($ssl_verify)
     {
         $this->ssl_verify = $ssl_verify;
     }
     
    /**
     * Request state getter
     *
     * @return bool
     */

     public function isSuccess()
     {
         return $this->is_success;
     }
 
    /**
     * Performs card sale
     *
     * @param array $params Sale Params
     * @return array
     */
     public function cardSale($params)
     {
         return $this->call(
	public function cardSale($params)
         );
     }
 
    /**
     * Performs card sale by token
     *
     * @param array $params Sale Params
     * @return array
     */
     public function cardSaleByToken($params)
     {
         return $this->call(
	public function cardSaleByToken($params)
         );
     }
 
    /**
     * Card authorization
     *
     * @param array $params Authorization params
     * @return array
     */
     public function cardAuthorization($params)
     {
         return $this->call(
	public function cardAuthorization($params)
         );
     }
 
    /**
     * Card authorization by token
     *
     * @param array $params Authorization params
     * @return array
     */
     public function cardAuthorizationByToken($params)
     {
         return $this->call(
	public function cardAuthorizationByToken($params)
         );
     }
     
    /**
     * PayPal authorization
     *
     * @param $params
     * @return array
     */

     public function paypalAuthorization($params)
     {
         return $this->call(
	public function paypalAuthorization($params)
         );
     }
 
    /**
     * Performs capture from authorized card
     *
     * @param array $params Capture authorization params
     * @return array
     */
     public function captureAuthorization($params)
     {
         return $this->call(
	public function captureAuthorization($params)
         );
     }
 
    /**
     * Performs closing of card authorization, basing on authorization card ID
     *
     * @param array $params Close authorization params
     * @return array
     */
     public function closeAuthorization($params)
     {
         return $this->call(
	public function closeAuthorization($params)
         );
     }
 
    /**
     * Performs refund
     *
     * @param array $params Refund params
     * @return array
     */
     public function refund($params)
     {
         return $this->call(
	public function refund($params)
             $params
         );
     }

     /**
      * Get sale info
      *
@@ -234,12 +150,7 @@ public function getSaleInfo($params)
         );
     }
     
    /**
     * Get sale authorization info
     *
     * @param array $params Get sale authorization info params
     * @return array
     */

     public function getAuthorizationInfo($params)
     {
         return $this->call(
	public function getAuthorizationInfo($params)
         );
     }
 
    /**
     * Performs sale status check
     *
     * @param array $params Check sale status
     * @return array
     */
     public function checkSaleStatus($params)
     {
         return $this->call(
	public function checkSaleStatus($params)
         );
     }
 
    /**
     * Direct debit sale
     *
     * @param array $params Direct debit params
     * @return array
     */
     public function directDebitSale($params)
     {
         return $this->call(
	public function directDebitSale($params)
         );
     }
 
    /**
     * Sofort sale
     *
     * @param array $params Sofort params
     * @return array
     */
     public function sofortSale($params)
     {
         return $this->call(
	public function sofortSale($params)
         );
     }
 
    /**
     * iDeal sale
     *
     * @param $params iDeal transaction params
     * @return array
     */
     public function idealSale($params)
     {
         return $this->call(
	public function idealSale($params)
         );
     }
 
    /**
     * iDeal banks list
     *
     * @return array
     */
 	public function idealBankCodes()
     {
         return $this->call(
	public function idealBankCodes()
         );
     }
 
    /**
     * Bank transfer sale
     *
     * @param array $params Bank transfer sale params
     * @return array
     */
     public function bankTransferSale($params)
     {
         return $this->call(
@@ -338,12 +214,7 @@ public function bankTransferSale($params)
         );
     }
     
    /**
     * PayPal sale
     *
     * @param array $params Paypal sale params
     * @return array
     */

     public function paypalSale($params)
     {
         return $this->call(
	public function paypalSale($params)
         );
     }
 
    /**
     * Cancels Paypal recurring profile
     *
     * @param array $params Paypal params
     * @return array
     */
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
	public function resaleBySale($params)
         );
     }
 
    /**
     * Performs resale by authorization ID
     *
     * @param array $params Resale by authorization params
     * @return array
     */
     public function resaleByAuthorization($params)
     {
         return $this->call(
	public function resaleByAuthorization($params)
         );
     }
 
    /**
     * Checks if a card is enrolled in the 3D-Secure program.
     *
     * @param array $params Is card 3d secure params
     * @return array
     */
     public function checkCard3DSecure($params)
     {
         return $this->call(
	public function checkCard3DSecure($params)
         );
     }
 
    /**
     * Checks if a card is enrolled in the 3D-Secure program, based on the card's token.
     *
     * @param array $params Is card 3d secure params
     * @return array
     */
     public function checkCard3DSecureByToken($params)
     {
         return $this->call(
@@ -427,12 +273,6 @@ public function checkCard3DSecureByToken($params)
         );
     }
 
    /**
     * Performs sale by ID 3d secure authorization
     *
     * @param array $params Sale by 3d secure authorization params
     * @return array
     */
     public function saleBy3DSecureAuthorization($params)
     {
         return $this->call(
	public function saleBy3DSecureAuthorization($params)
             $params
         );
     }
    
    /**
     * Perform check card
     *
     * @param array $params Check card params
     * @return array
     */

     public function checkCard($params)
     {
         return $this->call(
@@ -457,12 +291,7 @@ public function checkCard($params)
         );
     }
     
    /**
     * Perform check card by token
     *
     * @param array $params Check card params
     * @return array
     */

     public function checkCardByToken($params)
     {
         return $this->call(
@@ -472,18 +301,9 @@ public function checkCardByToken($params)
         );
     }
 
    /**
     * Method responsible for preparing, setting state and returning answer from rest server
     *
     * @param string $method
     * @param string $request
     * @param array $params
     * @return array
     */
     protected function call($method, $request, $params)
     {
         $this->is_success = false;

         if (is_object($params))
         {
             $params = (array) $params;
	protected function call($method, $request, $params)
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
 
    /**
     * Checking error mechanism
     *
     * @param array $validate_params
     * @throws \Exception
     */
     protected function checkForErrors($validate_params)
     {
         foreach ($validate_params as $key => $error)
@@ -528,37 +337,19 @@ protected function checkForErrors($validate_params)
         }
     }
 
    /**
     * Check if method is allowed
     *
     * @param string $method_type
     * @return bool
     */
     protected function checkRequestMethod($method_type)
     {
         $request_method = strtolower($method_type);

         if(in_array($request_method, $this->allowed_request_methods))
         {
             return true;
         }

         return false;
     }
 
   /**
    * Method responsible for pushing data to REST server
    *
    * @param string $method
    * @param string $method_type
    * @param string $request - JSON
    * @return array
    * @throws \Exception
    */
     protected function pushData($method, $method_type, $request)
     {
         $ch = curl_init();

         curl_setopt($ch, CURLOPT_URL, $this->api_url . $method);
         curl_setopt($ch, CURLOPT_POST, 1);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
	 protected function pushData($method, $method_type, $request)
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
