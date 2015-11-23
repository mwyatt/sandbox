<?php

call_user_func_array(function($name = 'sample', $id = 1) {
	echo '<pre>';
	print_r($name);
	print_r($id);
	echo '</pre>';
	exit;
	
}, [/*'foo' => 'bar', 'name' => 'mr music', 'id' => 290*/]);
