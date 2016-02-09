

// any api enhancements? 
if (!empty($requestServiceEnhancements)) {
    $request['requestedShipment']['serviceEnhancements'] = [
        'enhancementType' => ['serviceEnhancementCode' => ['code' => $requestServiceEnhancements]]
    ];
}
