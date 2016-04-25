<?php

ini_set('display_startup_errors',1);
ini_set('display_errors',1);
error_reporting(-1);

// key settings
$applicationId = '0127229000';
$adminUsername = 'martin@audiovisualonline.co.ukAPI';
$adminPassword = 'Password2014!';
$applicationPassword = '%s[FSY!HY&"&`j7U';
$creationDate = gmdate('Y-m-d\TH:i:s') . 'z';
$nonce = mt_rand();
$nonceDatePassword = pack("A*", $nonce) . pack("A*", $creationDate) . pack("H*", sha1($applicationPassword));
$passwordDigest = base64_encode(pack('H*', sha1($nonceDatePassword)));
$nonceEncoded = base64_encode($nonce);

$soapClientOptions = [
    'cache_wsdl' => 'WSDL_CACHE_NONE',
    'stream_context' => stream_context_create(array('http'=> array(
        'protocol_version'=>'1.0',
        'header' => 'Connection: Close'
    ))),
    'local_cert' => './certs-royalmail/rm_bundle.pem',
    'passphrase' => $adminPassword,
    'trace' => true,
    'soap_version' => 'SOAP_1_1',
    // 'exceptions' => 0,
    'ssl_method' => 'SOAP_SSL_METHOD_SSLv3',
    'location' => 'https://api.royalmail.com/shipping/onboarding'
];

$soapClient = new \SoapClient('./ShippingAPI_V2_0_8.wsdl', $soapClientOptions);
$soapClient->__setLocation($soapClientOptions['location']);

$headerXml = '
    <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
        <wsse:UsernameToken wsu:Id="UsernameToken-D8D094FC22716E3EDE14258880881317">
            <wsse:Username>' . $adminUsername . '</wsse:Username>
            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">' . $passwordDigest . '</wsse:Password>
            <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">' . $nonceEncoded . '</wsse:Nonce>
            <wsu:Created>' . $creationDate . '</wsu:Created>
        </wsse:UsernameToken>
    </wsse:Security>
';

//push the header into soap
$HeaderObject = new \SoapVar( $headerXml, XSD_ANYXML );                           
//push soap header
$header = new \SoapHeader( 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd', 'Security', $HeaderObject );
$soapClient->__setSoapHeaders($header);




$integrationHeader = [
    'dateTime' => gmdate('Y-m-d\TH:i:s') . 'z',
    'version' => '2',
    'identification' => [
        'applicationId' => $applicationId,
        'transactionId' => 1
    ]
];

// build the request
$requestCreateShipment = [
    'integrationHeader' => $integrationHeader,
    'requestedShipment' => [
        'shipmentType' => ['code' => 'Delivery'],
        'serviceOccurrence' => 1,
        'serviceType' => ['code' => 1],
        'serviceOffering' => ['serviceOfferingCode' => ['code' => 'CRL']],
        'serviceFormat' => ['serviceFormatCode' => ['code' => 'P']],
        'shippingDate' => date('Y-m-d'),
        'recipientContact' => [
            'name' => 'Martin Wyatt'
        ],
        'recipientAddress' => [
            'addressLine1' => 'Unit 2 The Sidings',
            'postTown' => 'Bacup',
            'postcode' => 'EC1A 1BB'
        ],
        'items' => [
            'item' => [
                'numberOfItems' => 1,
                'weight' => [
                    'unitOfMeasure' => ['unitOfMeasureCode' => ['code' => 'g']],
                    'value' => 50
                ]
            ]
        ]
    ]
];

$request1DRanges = [
    'integrationHeader' => $integrationHeader,
    'serviceReferences' => [
        'serviceReference' => [
            'serviceOccurence' => 1,
            'serviceType' => ['code' => 'D'],
            'serviceOffering' => ['serviceOfferingCode' => ['code' => 'SD1']],
            'shippingDate' => date('Y-m-d'),
        ]
    ]
];

$soapMethod = 'createShipment';
$soapData = $requestCreateShipment;
// $soapMethod = 'request1DRanges';
// $soapData = $request1DRanges;

try {
    $response = $soapClient->__soapCall($soapMethod, [$soapData], ['soapaction' => 'https://api.royalmail.com/shipping/onboarding']);
    echo '<pre>';
    print_r($response);
    echo '</pre>';
    exit;
    

// header("Content-type: text/xml;charset=utf-8");
// echo $soapClient->__getLastRequest();

// file_put_contents('/var/www/html/sandbox/royal-mail-shipping-api/dan/soap-current-attempt-request.xml', $soapClient->__getLastRequest());

echo '<pre>';
print_r('variable');
echo '</pre>';
exit;

} catch (Exception $exception) {
    echo '<pre>';
    print_r($exception->getMessage());
    echo '<pre>';
    echo '<pre>';
    print_r($exception);
    echo '</pre>';
    exit;
    

    // print_r("REQUEST:\n" .  . "\n");
    // echo '</pre>';
}
