<?php

echo '<pre>';
print_r(json_decode(readfile('routes.json')));
echo '</pre>';
exit;

