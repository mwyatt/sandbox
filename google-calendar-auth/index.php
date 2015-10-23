<?php

include 'vendor/autoload.php';
$client = new Google_Client();
$client->setAuthConfigFile('client_secret_260082020815-0p0kd2im0dtmn03thovs1laj45i3mil3.apps.googleusercontent.com.json');
$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/oauth2callback.php');
echo '<pre>';
print_r($client);
echo '</pre>';
exit;
