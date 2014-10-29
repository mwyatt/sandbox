<?php
$hostname = '{mail.audiovisualonline.co.uk/imap/novalidate-cert}INBOX';
$username = 'martin@audiovisualonline.co.uk';
$password = '@4fP+73=XiIL';
$mailBox = imap_open($hostname, $username, $password);
$folders = imap_list($mailBox, $hostname, '*');
$emails = imap_search($mailBox, 'all');
foreach ($emails as $emailId) {
	$overview = imap_fetch_overview($mailBox, $emailId, 0);
	$overview->subject

	echo '<pre>';
	print_r($overview);
	echo '</pre>';
}

imap_close($mailBox);
exit;

/* if emails are returned, cycle through each... */
if($emails) {
	
	/* begin output var */
	$output = '';
	
	/* put the newest emails on top */
	rsort($emails);
	
	/* for every email... */
	foreach($emails as $email_number) {
		
		/* get information specific to this email */
		
		/* output the email header information */
		$output.= '<div class="toggler '.($overview[0]->seen ? 'read' : 'unread').'">';
		$output.= '<span class="subject">'.$overview[0]->subject.'</span> ';
		$output.= '<span class="from">'.$overview[0]->from.'</span>';
		$output.= '<span class="date">on '.$overview[0]->date.'</span>';
		$output.= '</div>';
		
		/* output the email body */
		$output.= '<div class="body">'.$message.'</div>';
	}
	
	echo $output;
} 

/* close the connection */
?>
