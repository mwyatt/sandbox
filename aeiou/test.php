<?php

// parse from 'Account Mailer <admin@audiovisualonline.co.uk>'
// to 'admin@audiovisualonline.co.uk'
$from = 'Account Mailer <admin@audiovisualonline.co.uk>';
$from = substr($from, strpos($from, '<') + 1);
$from = str_replace('>', '', $from);

echo "\n\n";
echo $from;
echo "\n\n";