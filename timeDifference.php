<?php

$timeBefore = time();
$timeAfter = time();
$timeFiveMins = 60 * 5;

$timeDifference = $timeBefore - $timeAfter;
$isWarningTime = $timeDifference >= $timeFiveMins;

($isWarningTime)
