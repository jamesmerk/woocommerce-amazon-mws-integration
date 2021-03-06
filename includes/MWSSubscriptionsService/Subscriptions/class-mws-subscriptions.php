<?php

/**
* Class responsible for Creating and Updating MWS Subscriptions
* 
* @version 0.1.0
* @since 0.11.0
*/

require_once(MWS_CONFIG);
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Client.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/CreateSubscriptionInput.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/CreateSubscriptionResponse.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/CreateSubscriptionResult.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/UpdateSubscriptionInput.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/UpdateSubscriptionResponse.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/UpdateSubscriptionResult.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/Subscription.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/Destination.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/AttributeKeyValueList.php';
require_once WOO_AMZ_PLUGIN_DIR . 'includes/MWSSubscriptionsService/Model/AttributeKeyValue.php';


class MWS_Subscriptions {

    /**
     * MWS Subscriptions endpoint
     * 
     * @since 0.11.0
     */
    private static $serviceUrl = "https://mws.amazonservices.com/Subscriptions/2013-07-01";


    function __construct( $action = NULL ) {

        if ( $action == 'CreateSubscription' ) {

            self::invokeCreateSubscription( self::getHttpClient(), self::createSubscriptionRequest() );

        }

        if ( $action == 'UpdateSubscription' ) {

            self::invokeUpdateSubscription( self::getHttpClient(), self::updateSubscriptionRequest() );

        }

    }
    
    /**
     * Get an instance of the MWS Subscriptions Client
     * 
     * @since 0.11.0
     * 
     * @return MWSSubscriptionsService_Client client
     */
    private static function getHttpClient() {

        $config = array (
            'ServiceURL' => self::$serviceUrl,
            'ProxyHost' => null,
            'ProxyPort' => -1,
            'ProxyUsername' => null,
            'ProxyPassword' => null,
            'MaxErrorRetry' => 3,
        );
         
        $service = new MWSSubscriptionsService_Client(
            
            AWS_ACCESS_KEY_ID,
            AWS_SECRET_ACCESS_KEY,
            APPLICATION_NAME,
            APPLICATION_VERSION,
            $config
        );
         
        return $service;

    }

    /**
     * Create a subscription request to be used in invoking method invokeCreateSubscription
     * 
     * @since 0.11.0
     * 
     * @return MWSSubscriptionsService_Model_CreateSubscriptionInput $request
     */
    private static function createSubscriptionRequest() {

        $feed = new TFS_MWS_FEED();

        /**
         * Get an instance of MWSSubscriptionsService_Model_AttributeKeyValue and set the parameters
         */
        $attributeKeyValue = new MWSSubscriptionsService_Model_AttributeKeyValue();
        $attributeKeyValue->setKey('sqsQueueUrl');
        $attributeKeyValue->setValue('https://sqs.us-east-2.amazonaws.com/838401002254/woo_amz_queue');

        /**
         * Get an instance of MWSSubscriptionsService_Model_AttributeKeyValueList and set the parameters
         */
        $attributeKeyValueList = new MWSSubscriptionsService_Model_AttributeKeyValueList();
        $attributeKeyValueList->setmember( $attributeKeyValue );

        /**
         * Get an instance of MWSSubscriptionsService_Model_Destination, set the delivery channel and attribute list
         */
        $destination = new MWSSubscriptionsService_Model_Destination();
        $destination->setDeliveryChannel( 'SQS' );
        $destination->setAttributeList( $attributeKeyValueList );

        /**
         * Get an instance of MWSSubscriptionsService_Model_Subscription and set its parameters
         */
        $subscription = new MWSSubscriptionsService_Model_Subscription();
        $subscription->setNotificationType('FeedProcessingFinished');
        $subscription->setDestination( $destination );
        $subscription->setIsEnabled(  TRUE );

        /**
         * Get an instance of MWSSubscriptionsService_Model_CreateSubscriptionInput and set its parameters
         */
        $request = new MWSSubscriptionsService_Model_CreateSubscriptionInput();
        $request->setSellerId( MERCHANT_ID );
        $request->setMWSAuthToken( MERCHANT_ID );
        $request->setMarketplaceId('ATVPDKIKX0DER');
        $request->setSubscription( $subscription );
        
        return $request;

    }

    /**
     * Create an MWS Subscription and Log the Response
     * 
     * @since 0.11.0
     * 
     * @param MWSSubscriptionsService_Client $service
     * @param MWSSubscriptionsService_Model_CreateSubscriptionInput $request
     */
    private static function invokeCreateSubscription($service, $request)
    {
        try {
          $response = $service->CreateSubscription($request);
  
          echo ("Service Response\n");
          echo ("=============================================================================\n");
  
          $dom = new DOMDocument();
          $dom->loadXML($response->toXML());
          $dom->preserveWhiteSpace = false;
          $dom->formatOutput = true;
          echo $dom->saveXML();
          echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
  
       } catch (MWSSubscriptionsService_Exception $ex) {
          echo("Caught Exception: " . $ex->getMessage() . "\n");
          echo("Response Status Code: " . $ex->getStatusCode() . "\n");
          echo("Error Code: " . $ex->getErrorCode() . "\n");
          echo("Error Type: " . $ex->getErrorType() . "\n");
          echo("Request ID: " . $ex->getRequestId() . "\n");
          echo("XML: " . $ex->getXML() . "\n");
          echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");
       }
   }

    /**
     * Create a subscription request to be used in invoking method invokeCreateSubscription
     * 
     * @since 0.11.0
     * 
     * @return MWSSubscriptionsService_Model_UpdateSubscriptionInput $request
     */
    private static function updateSubscriptionRequest() {

        $feed = new TFS_MWS_FEED();

        /**
         * Get an instance of MWSSubscriptionsService_Model_AttributeKeyValue and set the parameters
         */
        $attributeKeyValue = new MWSSubscriptionsService_Model_AttributeKeyValue();
        $attributeKeyValue->setKey('sqsQueueUrl');
        $attributeKeyValue->setValue('https://sqs.us-east-2.amazonaws.com/838401002254/woo_amz_queue');

        /**
         * Get an instance of MWSSubscriptionsService_Model_AttributeKeyValueList and set the parameters
         */
        $attributeKeyValueList = new MWSSubscriptionsService_Model_AttributeKeyValueList();
        $attributeKeyValueList->setmember( $attributeKeyValue );

        /**
         * Get an instance of MWSSubscriptionsService_Model_Destination, set the delivery channel and attribute list
         */
        $destination = new MWSSubscriptionsService_Model_Destination();
        $destination->setDeliveryChannel( 'SQS' );
        $destination->setAttributeList( $attributeKeyValueList );

        /**
         * Get an instance of MWSSubscriptionsService_Model_Subscription and set its parameters
         */
        $subscription = new MWSSubscriptionsService_Model_Subscription();
        $subscription->setNotificationType('FeedProcessingFinished');
        $subscription->setDestination( $destination );
        $subscription->setIsEnabled(  TRUE );

        /**
         * Get an instance of MWSSubscriptionsService_Model_CreateSubscriptionInput and set its parameters
         */
        $request = new MWSSubscriptionsService_Model_UpdateSubscriptionInput();
        $request->setSellerId( MERCHANT_ID );
        $request->setMWSAuthToken( MERCHANT_ID );
        $request->setMarketplaceId('ATVPDKIKX0DER');
        $request->setSubscription( $subscription );
        
        return $request;

    }


   /**
    * Update an existing Amazon Subscription and Log the response
    *
    * @since 0.11.0
    * 
    * @param MWSSubscriptionsService_Client $service
    * @param MWSSubscriptionsService_Model_UpdateSubscriptionInput $request
    */
   private static function invokeUpdateSubscription($service, $request)
   {
       try {

        $response = $service->UpdateSubscription($request);

        echo ("Service Response\n");
        echo ("=============================================================================\n");

        $dom = new DOMDocument();
        $dom->loadXML($response->toXML());
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        echo $dom->saveXML();
        echo("ResponseHeaderMetadata: " . $response->getResponseHeaderMetadata() . "\n");
 
      } catch (MWSSubscriptionsService_Exception $ex) {

        echo("Caught Exception: " . $ex->getMessage() . "\n");
        echo("Response Status Code: " . $ex->getStatusCode() . "\n");
        echo("Error Code: " . $ex->getErrorCode() . "\n");
        echo("Error Type: " . $ex->getErrorType() . "\n");
        echo("Request ID: " . $ex->getRequestId() . "\n");
        echo("XML: " . $ex->getXML() . "\n");
        echo("ResponseHeaderMetadata: " . $ex->getResponseHeaderMetadata() . "\n");

      }

    }

} //END class MWS_Subscriptions