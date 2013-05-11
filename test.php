<?php 
function isNew($timeAdded)
    {
        if ($timeAdded < 14) {
            return true;
        }
    }


var_dump(isNew(20))

 ?>