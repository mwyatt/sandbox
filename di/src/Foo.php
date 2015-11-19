<?php

namespace Happy;

class Foo
{
	

	public $bar;


	function __construct(\Happy\Bar $bar)
	{
		$this->bar = $bar;
	}
}
