<?php

namespace OriginalThing\Controller;

class Index
{


	public function home()
	{
		echo '<pre>';
		print_r('$request');
		echo '</pre>';
		exit;
		
		
	}


	public function foo($request)
	{
		echo '<pre>';
		print_r($request);
		echo '</pre>';
		exit;
		
	}
}
