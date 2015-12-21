<?php

$genericArray = ['zebadia', 'apples', 2, 'one', true, 'foo' => 'bar'];

$object1 = new StdClass;
$object1->id = 1;
$object1->name = 'David';
$object2 = new StdClass;
$object2->id = 2;
$object2->name = 'zebadia';
$object3= new StdClass;
$object3->id = 3;
$object3->name = 'hammock';
$object4= new StdClass;
$object4->id = 4;
$object4->name = 'hammock';
$objectArray = [$object1, $object2, $object3, $object4];


class ObjectArray extends \ArrayIterator
{


	protected function unsetGetCopy()
	{
		$thisCopy = $this->getArrayCopy();

		// done 2 times because first time it leaves one?
		foreach ($this as $key => $value) {
			$this->offsetUnset($key);
		}
		foreach ($this as $key => $value) {
			$this->offsetUnset($key);
		}
		return $thisCopy;
	}
	

	public function keyByProperty($property)
	{
		$thisCopy = $this->unsetGetCopy();
	    foreach ($thisCopy as $entity) {
            $this[$entity->$property] = $entity;
	    }
	}


	public function keyByPropertyMulti($property)
	{
		$thisCopy = $this->unsetGetCopy();
	    foreach ($thisCopy as $value) {
	    	if (empty($this[$value->$property])) {
	    		$this[$value->$property] = [];
	    	}
            $this[$value->$property][] = $value;
	    }
	}


	public function filterOutByProperty($property, $value)
	{
		foreach ($this as $key => $entity) {
			if ($entity->$property == $value) {
				$this->offsetUnset($key);
			}
		}
	}


	public function extractProperty($property)
	{
		$collection = [];
		foreach ($this as $value) {
	        $collection[] = $value->$property;
		}
		return $collection;
	}
}

$iterator = new \ObjectArray($objectArray, 19372193);

// $iterator->uasort(function ($a, $b) {
//     return strcasecmp($b->name, $a->name);
// });

// $iterator->keyByProperty('name');
// $iterator->keyByPropertyMulti('name');
// $iterator->filterOutByProperty('name', 'hammock');
echo '<pre>';
print_r(reset($iterator));
echo '</pre>';

echo '<pre>';
print_r($iterator->extractProperty('id'));
echo '</pre>';


echo '<pre>';
print_r($iterator->getFlags());
echo '</pre>';
exit;
