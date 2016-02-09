<?php
parse_str('ok=world&another=ok', $queryParts);
echo '<pre>';
print_r(explode('?', $_SERVER['REQUEST_URI']));
echo '</pre>';
exit;


// parse_str(''ok=world&another=ok', $queryParts);

// echo '<pre>';
// print_r(parse_str());
// echo '</pre>';
// exit;
