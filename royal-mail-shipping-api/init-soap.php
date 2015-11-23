<?php

$time = gmdate('Y-m-d\TH:i:s');
$created = '2015-11-10T17:42:55.685Z';
$nonce = 16999;
$api_password = 'Password1*';
$nonce_date_pwd = pack("A*",$nonce) . pack("A*",$created) . pack("H*", sha1($api_password));
$passwordDigest = base64_encode(pack('H*',sha1($nonce_date_pwd)));
$ENCODEDNONCE = base64_encode($nonce);

print "MANUAL GENERATED VALUES";
print "\n";                          
print 'Created = ' . $created;
print "\n";
print 'Unencoded Nonce = ' . $nonce;
print "\n";
print 'Encoded Nonce = ' . $ENCODEDNONCE;
print "\n";
print 'Password Digest = ' . $passwordDigest;








$applicationId = '0127229000';
$applicationPassword = '%s[FSY!HY&"&`j7U';
$creationDate = gmdate('Y-m-d\TH:i:s\Z');
$nonce = mt_rand();
$nonceDatePassword = pack("A*", $nonce) . pack("A*", $creationDate) . pack("H*", sha1($applicationPassword));
$passwordDigest = base64_encode(pack('H*', sha1($nonceDatePassword)));
$nonceEncoded = base64_encode($nonce);

ob_start();

// render template using extracted variables
include 'header.php';
$headerXml = ob_get_contents();

// destroy output buffer
// @todo convert to ob_clean
ob_end_clean();

// init soap
$soapClient = new SoapClient('ShippingAPI_V2_0_8.wsdl', [
    'soap_version' => SOAP_1_1,
    'uri' => 'http://www.royalmailgroup.com/api/ship/V2',
    'location' => 'https://api.royalmail.com/shipping/onboarding',
    'local_cert' => '/etc/ssl/certs/royalmail/rm_bundle.pem',
    'passphrase' => $applicationPassword,
    'ssl_method' => 'SOAP_SSL_METHOD_TLS',
    'exceptions' => 1,
    'trace' => 1
]);

// add header
$headerSoapVar = new SoapVar($headerXml, XSD_ANYXML);
$header = new SoapHeader('http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd', 'Security', $headerSoapVar);
$soapClient->__setSoapHeaders($header);

// add input request
$data = new stdClass;
$data->orderTrackingId = 1;
$data->shippingName = 'shippingName';
$data->shippingCompany = 'shippingCompany';
$data->shippingAddress1 = 'shippingAddress1';
$data->shippingAddress2 = 'shippingAddress2';
$data->shippingTown = 'shippingTown';
$data->shippingPostcode = 'shippingPostcode';
$data->orderTrackingBoxes = 'orderTrackingBoxes';
$data->orderTrackingWeight = 'orderTrackingWeight';

// unknown request vars?
$requestServiceType = 'D';
$requestServiceCode = 'SD1';
$requestServiceFormat = '';
$requestServiceEnhancements = '';

// build the request
$request = [
    'integrationHeader' => [
        'dateTime' => $creationDate,
        'version' => '2',
        'identification' => [
            'applicationId' => $applicationId,
            'transactionId' => $data->orderTrackingId
        ]
    ],
    'requestedShipment' => [
        'shipmentType' => ['code' => 'Delivery'],
        'serviceOccurrence' => '1',
        'serviceType' => ['code' => $requestServiceType],
        'serviceOffering' => ['serviceOfferingCode' => ['code' => $requestServiceCode]],
        'serviceFormat' => ['serviceFormatCode' => ['code' => $requestServiceFormat]],
        'shippingDate' => date('Y-m-d'),
        'recipientContact' => [
            'name' => $data->shippingName,
            'complementaryName' => $data->shippingCompany
        ],
        'recipientAddress' => [
            'addressLine1' => $data->shippingAddress1,
            'addressLine2' => $data->shippingAddress2,
            'postTown' => $data->shippingTown,
            'postcode' => $data->shippingPostcode
        ],
        'items' => [
	        'item' => [
	            'numberOfItems' => $data->orderTrackingBoxes,
	            'weight' => [
	            	'unitOfMeasure' => ['unitOfMeasureCode' => ['code' => 'g']],
		            'value' => ($data->orderTrackingWeight * 1000) // weight of each individual item
		        ]
	        ]
        ]
    ]
];

// any api enhancements? 
if (!empty($requestServiceEnhancements)) {
    $request['requestedShipment']['serviceEnhancements'] = [
        'enhancementType' => ['serviceEnhancementCode' => ['code' => $requestServiceEnhancements]]
    ];
}

// try to make the call
try {
    $response = $soapClient->__soapCall('createShipment', [$request], ['soapaction' => 'https://api.royalmail.com/shipping/onboarding']);
} catch (Exception $exception) {
    echo $exception->getMessage(); 
    echo "REQUEST:\n" . $soapClient->__getLastRequest() . "\n";
    die;
}
