<?php

namespace PackageName\Controller;

class Index
{
	
	
	public function home()
	{
		return ['home'];
	}


	public function product($name, $id)
	{
		return [$name, $id];
	}


	public function bar()
	{
		echo '<pre>';
		print_r('bar');
		echo '</pre>';
		
	}


	public function asset($path)
	{
		return $path;
	}
}
