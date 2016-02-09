<?php

// key settings
$applicationId = '0127229000';
$applicationPassword = '%s[FSY!HY&"&`j7U';
$creationDate = gmdate('Y-m-d\TH:i:s');
$nonce = mt_rand();
$nonceDatePassword = pack("A*", $nonce) . pack("A*", $creationDate) . pack("H*", sha1($applicationPassword));
$passwordDigest = base64_encode(pack('H*', sha1($nonceDatePassword)));
$nonceEncoded = base64_encode($nonce);

$headerXml = '
    <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
        <wsse:UsernameToken wsu:Id="Username-000">
            <wsse:Username>' . $applicationId . '</wsse:Username>
            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest">' . $passwordDigest . '</wsse:Password>
            <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary">' . $nonceEncoded . '</wsse:Nonce>
            <wsu:Created>' . $creationDate . '</wsu:Created>
        </wsse:UsernameToken>
    </wsse:Security>
';

$headerSoapVar = new \SoapVar($headerXml, XSD_ANYXML);
$soapHeader = new \SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd', 'Security', $headerSoapVar);

$soapClient = new \SoapClient('ShippingAPI_V2_0_8.wsdl', [
    'cache_wsdl' => 'WSDL_CACHE_NONE',
    'local_cert' => '/etc/ssl/certs/royalmail/rm_bundle.pem',
    'passphrase' => $applicationPassword,
    'trace' => true,
    'ssl_method' => 'SOAP_SSL_METHOD_SSLv3',
    'location' => 'https://api.royalmail.com/shipping/onboarding'
]);
$soapClient->__setSoapHeaders($soapHeader);

// add input request
$data = new \stdClass;
// $data->orderTrackingId = 1;
$data->shippingName = 'shippingName';
$data->shippingCompany = 'shippingCompany';
$data->shippingAddress1 = 'shippingAddress1';
$data->shippingAddress2 = 'shippingAddress2';
$data->shippingTown = 'Burnley';
$data->shippingPostcode = 'OL13 9RW';
$data->orderTrackingBoxes = 'orderTrackingBoxes';
$data->orderTrackingWeight = 'orderTrackingWeight';

// unknown request vars?
// $requestServiceType = 'D';
// $requestServiceCode = 'SD1';
// $requestServiceFormat = '';
// $requestServiceEnhancements = '';

// build the request
$requestCreateShipment = [
    'integrationHeader' => [
        'dateTime' => $creationDate,
        'version' => '2',
        'identification' => [
            'applicationId' => $applicationId,
            'transactionId' => 'ffhi289'
        ]
    ],
    'requestedShipment' => [
        'shipmentType' => ['code' => 'Delivery'],
        'serviceType' => ['code' => 'CRL'],
        'serviceOffering' => ['serviceOfferingCode' => ['code' => 'C']],
        'shippingDate' => date('Y-m-d'),
        'recipientContact' => [
            'name' => $data->shippingName,
            'complementaryName' => $data->shippingCompany,
            'telephoneNumber' => 128397132871,
            'electronicAddress' => 'martin@audiovisualonline.co.uk'
        ],
        'recipientAddress' => [
            'addressLine1' => $data->shippingAddress1,
            'postTown' => $data->shippingTown,
            'postcode' => $data->shippingPostcode
        ]
        // 'items' => [
        //     'item' => [
        //         'numberOfItems' => $data->orderTrackingBoxes,
        //         'weight' => [
        //             'unitOfMeasure' => ['unitOfMeasureCode' => ['code' => 'g']],
        //             'value' => ($data->orderTrackingWeight * 1000) // weight of each individual item
        //         ]
        //     ]
        // ]
    ]
];

$requestD1Ranges = [
    'integrationHeader' => [
        'dateTime' => $creationDate,
        'version' => '2',
        'identification' => [
            'applicationId' => $applicationId,
            'transactionId' => ''
        ]
    ],
    'serviceReferences' => [
        // 'serviceReference' => 
    ]
];

try {
    $response = $soapClient->__soapCall('createShipment', [$requestCreateShipment], ['soapaction' => 'https://api.royalmail.com/shipping/onboarding']);

    echo '<pre>';
    print_r($response);
    echo '</pre>';
} catch (Exception $exception) {
    header("Content-type: text/xml;charset=utf-8");
    echo $soapClient->__getLastRequest();
    // echo '<pre>';
    // print_r($exception->getMessage());
    // echo '<pre>';
    // print_r("REQUEST:\n" .  . "\n");
    // echo '</pre>';
}
