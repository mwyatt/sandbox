<?xml version="1.0" encoding="UTF-8"?>
<soapenv:Envelope xmlns:oas="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:v1="http://www.royalmailgroup.com/integration/core/V1" xmlns:v2="http://www.royalmailgroup.com/api/ship/V2">
   <soapenv:Header>
      <wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd" xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
         <wsse:UsernameToken wsu:Id="UsernameToken-F4E6D808A9273819E614473554191864">
            <wsse:Username><?php echo $applicationId ?></wsse:Username>
            <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-username-token-profile-1.0#PasswordDigest"><?php echo $passwordDigest ?></wsse:Password>
            <wsse:Nonce EncodingType="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0#Base64Binary"><?php echo $nonceEncoded ?></wsse:Nonce>
            <wsu:Created><?php echo $creationDate ?></wsu:Created>
         </wsse:UsernameToken>
      </wsse:Security>
   </soapenv:Header>
   <soapenv:Body>
      <v2:createShipmentRequest>
         <v2:integrationHeader>
            <v1:dateTime>2015-11-12T08:52:03</v1:dateTime>
            <v1:version>2</v1:version>
            <v1:identification>
               <v1:applicationId>XXXX</v1:applicationId>
               <v1:transactionId>730222611</v1:transactionId>
            </v1:identification>
         </v2:integrationHeader>
         <v2:requestedShipment>
            <v2:shipmentType>
               <code>Delivery</code>
            </v2:shipmentType>
            <v2:serviceOccurrence>1</v2:serviceOccurrence>
            <v2:serviceType>
               <code>1</code>
            </v2:serviceType>
            <v2:serviceOffering>
               <serviceOfferingCode>
                  <code>CRL</code>
               </serviceOfferingCode>
            </v2:serviceOffering>
            <v2:serviceFormat>
               <serviceFormatCode>
                  <code>P</code>
               </serviceFormatCode>
            </v2:serviceFormat>
            <v2:shippingDate>2015-11-02</v2:shippingDate>
            <v2:recipientContact>
               <v2:name>Mr Tom Smith</v2:name>
               <v2:complementaryName>Department 98</v2:complementaryName>
               <v2:telephoneNumber>
                  <countryCode>0044</countryCode>
                  <telephoneNumber>07801123456</telephoneNumber>
               </v2:telephoneNumber>
               <v2:electronicAddress>
                  <electronicAddress>tom.smith@royalmail.com</electronicAddress>
               </v2:electronicAddress>
            </v2:recipientContact>
            <v2:recipientAddress>
               <addressLine1>Mount Pleasant</addressLine1>
               <postTown>London</postTown>
               <postcode>EC1A 1BB</postcode>
               <country>
                  <countryCode>
                     <code>GB</code>
                  </countryCode>
               </country>
            </v2:recipientAddress>
            <v2:items>
               <v2:item>
                  <v2:numberOfItems>1</v2:numberOfItems>
                  <v2:weight>
                     <unitOfMeasure>
                        <unitOfMeasureCode>
                           <code>g</code>
                        </unitOfMeasureCode>
                     </unitOfMeasure>
                     <value>100</value>
                  </v2:weight>
               </v2:item>
            </v2:items>
            <v2:customerReference>CustSuppRef1</v2:customerReference>
            <v2:senderReference>SenderReference1</v2:senderReference>
         </v2:requestedShipment>
      </v2:createShipmentRequest>
   </soapenv:Body>
</soapenv:Envelope>
