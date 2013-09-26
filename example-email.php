<?php

$headers = "From: " . 'me@martin-wyatt.com';
$headers .= "Reply-To: ". 'me@martin-wyatt.com' . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=iso-8859-1\r\n";

if (mail(
		'martin.wyatt@gmail.com'
		, 'example subject'
		, '<div>example html</div>'
		, $headers
	)) {
	exit('passed');
} else {
	exit('failed');
}
