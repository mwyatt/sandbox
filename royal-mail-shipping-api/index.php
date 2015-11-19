<?php

$response = trim(file_get_contents('example2.xml'));
// $response = simplexml_load_string($response);
$response = new SimpleXmlElement($response);
// $response = $response->getNameSpaces(true);

echo '<pre>';
print_r($response);
echo '</pre>';
exit;

echo $response->Body->Fault->faultcode . ' - ' . $response->Body->Fault->faultstring;


$request = new stdClass;
$request['env:ok'] = 'ok?';

echo '<pre>';
print_r($request);
echo '</pre>';
exit;


// 0127229000


$objSoapClient = new \SoapClient('lib/wsdl/royalmail/shipping/ShippingAPI_V2_0_8.wsdl', array(
    'soap_version' => SOAP_1_1,
    'trace' => 1,
    'uri' => 'http://www.royalmailgroup.com/api/ship/V2',
    'location' => 'https://api.royalmail.com/shipping/onboarding',
    'local_cert' => '/etc/ssl/certs/certificates/royalmail/shippingv2/rm_bundle.pem',
    'passphrase' => '', //Your passphrase when doing step 1
    'ssl_method' => 'SOAP_SSL_METHOD_TLS',
    'exceptions' => 1,
    'trace' => 1
));