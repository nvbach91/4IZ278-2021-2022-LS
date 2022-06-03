<?php

require_once './database/VEventBookedDB.php';

function checkCapacity($eventId) {
    $vEventBookedDB = new VEventBookedDB();
    $eventStatus = $vEventBookedDB->fetchByEventId($eventId);
    $capacity = (int)$eventStatus['t_free'];
    if($capacity == 0) {
        return true;
    } else {
        return false;
    }
}
?>