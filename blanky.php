<?php

$plainText = "
[image]
http://hello.com/
[/close]

[Specification Title]
Heading [-] Content
Heading [-] Content
Heading [-] Content
[/close]

[Specification Title]
Heading [-] Content
Heading [-] Content
Heading [-] Content
[/close]

";


echo '<pre>';
print_r($groups);
echo '</pre>';
exit;
return $groups;
