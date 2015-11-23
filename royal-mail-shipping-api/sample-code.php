<?php

$api_application_id = 'fisual';
$api_password = '%s[FSY!HY&"&`j7U';
$api_service_type = 'fast?';
$api_service_code = 'huh?';
$api_service_format = 'huh?';

$time = gmdate('Y-m-d\TH:i:s');
$created = gmdate('Y-m-d\TH:i:s\Z');
$nonce = mt_rand();
$nonce_date_pwd = pack("A*",$nonce) . pack("A*",$created) . pack("H*", sha1($api_password));
$passwordDigest = base64_encode(pack('H*',sha1($nonce_date_pwd)));
$ENCODEDNONCE = base64_encode($nonce);

$soapclient_options = array(); 
$soapclient_options['cache_wsdl'] = 'WSDL_CACHE_NONE'; 
$soapclient_options['local_cert'] = '/etc/ssl/certs/royalmail/rm_bundle.pem';
$soapclient_options['passphrase'] = $api_password;
$soapclient_options['trace'] = true;
$soapclient_options['ssl_method'] = 'SOAP_SSL_METHOD_SSLv3';
$soapclient_options['location'] = 'https://api.royalmail.com/shipping/onboarding';

// launch soap client
$client = new \SoapClient('ShippingAPI_V2_0_8.wsdl', [
    'soap_version' => SOAP_1_1,
    'trace' => 1,
    'uri' => 'http://www.royalmailgroup.com/api/ship/V2',
    'location' => 'https://api.royalmail.com/shipping/onboarding',
    'local_cert' => '/etc/ssl/certs/royalmail/rm_bundle.pem',
    'passphrase' => '', //Your passphrase when doing step 1
    'ssl_method' => 'SOAP_SSL_METHOD_TLS',
    'exceptions' => 1,
    'trace' => 1
]);

// $client = new SoapClient('ShippingAPI_V2_0_8.wsdl', $soapclient_options);
// $client->__setLocation($soapclient_options['location']);

// headers needed for royal mail
$HeaderObjectXML  = '<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
<wsse:UsernameToken wsu:Id="UsernameToken-000">
<wsse:Username>'. $api_application_id .'</wsse:Username>
<wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">' . $passwordDigest . '</wsse:Password>
<wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">' . $ENCODEDNONCE . '</wsse:Nonce>
<wsu:Created>' . $created . '</wsu:Created>
</wsse:UsernameToken>
</wsse:Security>';

// push the header into soap
$HeaderObject = new SoapVar( $HeaderObjectXML, XSD_ANYXML );

// push soap header
$header = new SoapHeader( 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd', 'Security', $HeaderObject );
$client->__setSoapHeaders($header);

// input
$data = new stdClass;
$data->order_tracking_id = 1;
$data->shipping_name = 'shipping_name';
$data->shipping_company = 'shipping_company';
$data->shipping_address1 = 'shipping_address1';
$data->shipping_address2 = 'shipping_address2';
$data->shipping_town = 'shipping_town';
$data->shipping_postcode = 'shipping_postcode';
$data->order_tracking_boxes = 'order_tracking_boxes';
$data->order_tracking_weight = 'order_tracking_weight';

//build the request
$request = array(
    'integrationHeader' => array(
            'dateTime' => $time,
            'version' => '1.0',
            'identification' => array(
            'applicationId' => $api_application_id,
            'transactionId' => $data->order_tracking_id
        )
    ),
    'requestedShipment' => array(
        'shipmentType' => array('code' => 'Delivery'),
        'serviceOccurence' => '1',
        'serviceType' => array('code' => $api_service_type),
        'serviceOffering' => array('serviceOfferingCode' => array('code' => $api_service_code)),
        'serviceFormat' => array('serviceFormatCode' => array('code' => $api_service_format)),
        'shippingDate' => date('Y-m-d'),
        'recipientContact' => array('name' => $data->shipping_name, 'complementaryName' => $data->shipping_company),
        'recipientAddress' => array('addressLine1' => $data->shipping_address1,  'addressLine2' => $data->shipping_address2, 'postTown' => $data->shipping_town, 'postcode' => $data->shipping_postcode),
        'items' => array('item' => array(
            'numberOfItems' => $data->order_tracking_boxes,
            'weight' => array( 'unitOfMeasure' => array('unitOfMeasureCode' => array('code' => 'g')),
            'value' => ($data->order_tracking_weight*1000) //weight of each individual item
        )
        )
        )
    )
);


// if any enhancements, add it into the array
if(!empty($api_service_enhancements)) {
$request['requestedShipment']['serviceEnhancements'] = array('enhancementType' => array('serviceEnhancementCode' => array('code' => $api_service_enhancements)));
}

//try make the call
try { 
$response = $client->__soapCall( 'createShipment', array($request), array('soapaction' => 'https://api.royalmail.com/shipping/onboarding') );
}           catch (Exception $e) {
//catch the error message and echo the last request for debug
echo $e->getMessage(); 
echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
die;
}

    

//check for any errors
if(isset($response->integrationFooter->errors)) { 
    $build = "";

    //check it wasn't a single error message
    if(isset($response->integrationFooter->errors->error->errorCode)) { 

        $build .= $output_error->errorCode.": ".$output_error->errorDescription."<br/>"; 

    } else {

        //loop out each error message, throw exception will be added ehre
        foreach($response->integrationFooter->errors->error as $output_error) { 
            $build .= $output_error->errorCode.": ".$output_error->errorDescription."<br/>";
        }

    }

    echo $build; die;

}

echo '<pre>';
print_r($response);
echo '</pre>';
exit;


print_r($response);

echo "REQUEST:\n" . $client->__getLastRequest() . "\n";
echo '<pre>';
print_r('variable');
echo '</pre>';
exit;

die;
