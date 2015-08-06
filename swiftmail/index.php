<?php

include 'vendor/autoload.php';

$transport = Swift_SmtpTransport::newInstance('smtp.gmail.com', 465, 'ssl')
  ->setUsername('martin.wyatt@gmail.com')
  ->setPassword(include 'config.php');
$mailer = Swift_Mailer::newInstance($transport);
$message = Swift_Message::newInstance()
  ->setSubject('Your subject')
  ->setFrom(['sales@audiovisualonline.co.uk' => 'Sales Man'])
  ->setTo(['martin.wyatt@gmail.com' => 'Martin Wyatt'])
  ->setBody('<h1>Here is the message itself</h1>', 'text/html');
try {
  $result = $mailer->send($message);
  var_dump($result);
} catch (Swift_TransportException $e) {
  var_dump($e->getMessage());
}

// do stuff with swiftmessage
// construct to init the transport and mailer
$mail->message->setSubject
