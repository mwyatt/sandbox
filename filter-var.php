<?php

var_dump(filter_var($_GET['email'], FILTER_VALIDATE_EMAIL));
exit;
