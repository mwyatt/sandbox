<?php

namespace OriginalThing\Controller;

class Index
{


	public function home($anything)
	{
		echo '<pre>';
		print_r($anything['id']);
		echo '</pre>';
		exit;
		
	}
}
