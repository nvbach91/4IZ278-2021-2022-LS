<?php 
function compareDates($dateToCompare) {
    date_default_timezone_set('Europe/Prague');
    $dateNow = date('Y-m-d H:i:s', time());
    //    17.6.              3.6
    if ($dateToCompare > $dateNow) {
        return false;
    }
    else {
        return true;
    }
}
?>