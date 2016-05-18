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


$soapData = [
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

'request1DRanges'