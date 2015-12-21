<?php


class Foo
{
	
	public $bar;

	function __construct($bar)
	{
		$this->bar = $bar;
	}
}


class Bar
{
	
	public $so = 'ok';
}


class Ree extends Foo
{

	public $lar = 'foo';
}



$bar = new Bar;
$foo = new Foo($bar);
$Ree = new Ree($bar);
$bar->so = 'huh?';


echo '<pre>';
print_r(get_class_vars('Ree'));
echo '</pre>';
exit;
