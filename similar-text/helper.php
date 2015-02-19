<?php


function orderByProperty($data, $key, $order = 'asc')
{
	$dataSingle = current($data);
	$sampleValue = $dataSingle[$key];
	$type = 'string';
	if (is_string($sampleValue)) {
		// $type = 'string';
	} elseif(is_int($sampleValue)) {
		$type = 'integer';
	}

	// sort
	uasort($data, function($a, $b) use ($key, $type, $order) {
		if ($type == 'string') {
			if ($order == 'asc') {
				return strcasecmp($a[$key], $b[$key]);
			} else {
				return strcasecmp($b[$key], $a[$key]);
			}
		}
		if ($type == 'integer') {
			if ($order == 'asc') {
				if ($a[$key] == $b[$key]) {
					return 0;
				}
				return $a[$key] < $b[$key] ? -1 : 1;
			} else {
				if ($a[$key] == $b[$key]) {
					return 0;
				}
				return $a[$key] > $b[$key] ? -1 : 1;
			}
		}

	});
	return $data;
}


function _similar($str1, $str2) {
    $strlen1=strlen($str1);
    $strlen2=strlen($str2);
    $max=max($strlen1, $strlen2);

    $splitSize=250;
    if($max>$splitSize)
    {
        $lev=0;
        for($cont=0;$cont<$max;$cont+=$splitSize)
        {
            if($strlen1<=$cont || $strlen2<=$cont)
            {
                $lev=$lev/($max/min($strlen1,$strlen2));
                break;
            }
            $lev+=levenshtein(substr($str1,$cont,$splitSize), substr($str2,$cont,$splitSize));
        }
    }
    else
    $lev=levenshtein($str1, $str2);

    $porcentage= -100*$lev/$max+100;
    if($porcentage>75)//Ajustar con similar_text
    similar_text($str1,$str2,$porcentage);

    return $porcentage;
}
