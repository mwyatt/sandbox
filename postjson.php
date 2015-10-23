<?php

$raw = file_get_contents('php://input');

echo '<pre>';
print_r(json_decode($raw));
echo '</pre>';
exit;
