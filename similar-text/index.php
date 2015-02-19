<?php

include 'helper.php';
$data = include 'data.php';

// resource
$filtered = [];
$cols = ['id', 'name', 'keywords'];

// query
$query = $_REQUEST['query'];
$query = str_replace('  ', ' ', $query);
$query = strtolower($query);

if (! $query) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	exit;
	
}

// perfect
foreach ($data as $product) {
	$match = false;
	foreach ($cols as $col) {
		$colValue = strtolower((string) $product[$col]);
	
		// no
		if ($colValue !== $query) {
			continue;
		}

		// flag
		$match = true;
	}

	// store
	if ($match) {
		$filtered[$product['id']] = $product;
	}
}

if ($filtered) {
	echo '<pre>';
	print_r($filtered);
	echo '</pre>';
	exit;
	
}

// partial spelled correctly
foreach ($data as $product) {
	$match = false;
	$score = 0;
	foreach ($cols as $col) {
		$colValue = strtolower((string) $product[$col]);
		$strpos = strpos($colValue, $query);
		
		// no
		if ($strpos === false) {
			continue;
		}

		// part match of a column, but spelled correctly, boost
		$score += $strpos;
		$match = true;
	}

	// must success
	if ($match) {
		$product['score'] = $score;
		$filtered[$product['id']] = $product;
	}
}

if (count($filtered)) {
	$filtered = orderByProperty($filtered, 'score', 'asc');
	echo '<pre>';
	print_r($filtered);
	echo '</pre>';
	exit;
	
}

// misspelled / minor match
foreach ($data as $product) {
	$percentages = [];
	foreach ($cols as $col) {
		$colValue = strtolower((string) $product[$col]);
		$percentage = _similar($colValue, $query);
		if ($percentage < 0) {
			continue;
		}
		$percentages[] = intval($percentage);
	}

	// store if hit
	if ($percentages) {
		$product['score'] = max($percentages);
		$filtered[$product['id']] = $product;
	}
}


if ($filtered) {
	$filtered = orderByProperty($filtered, 'score', 'desc');
	echo '<pre>';
	print_r($filtered);
	echo '</pre>';
	exit;
}

echo "<h1>'no match'</h1>";

echo '<pre>';
print_r($data);
echo '</pre>';
exit;







/*

		// word
		$position = strpos($colValue, $query);
		if ($position === false) {

			// penalty?
			$score += strlen($colValue);
		} else {
			$score += $position;
		}


		// divide the matches
		$score += levenshtein($colValue, $query);



 */


// how to work out if something is irrelivant?
// if levenschtein == length of string?
// if strpos === false?


// lower the number the closer the match
// start at 0
// full match reduce by 100 '' == ''
// add on 'strpos' - for fullword match, closer to start the smaller the reduction if strpos == false then +(length) penalty
// add on levenshtein - for mispelt or close match smaller reduction means closer

// id
// name
// keyword

// 1. perfect match (==) -100
// 2. full word match (strpos) + result
// 3. levenshtein closeness (levenshtein) + result
// minus off using relevance col - relevance
// lowest number wins




// store all products in a serialized cache
// loop through all and perform levenshtein
// this will be the biggest cost
// spelling errors
