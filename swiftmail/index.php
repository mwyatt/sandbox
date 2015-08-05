<?php

include 'vendor/autoload.php';

// Create the message
$message = Swift_Message::newInstance()
  ->setSubject('Your subject')
  ->setFrom(['sales@audiovisualonline.co.uk' => 'Sales Man'])
  ->setTo(['martin.wyatt@gmail.com' => 'Martin Wyatt'])
  ->setBody('<h1>Here is the message itself</h1>', 'text/html');

  echo '<pre>';
  print_r($message);
  echo '</pre>';
  exit;
  