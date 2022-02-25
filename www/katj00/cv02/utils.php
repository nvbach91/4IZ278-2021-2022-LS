<?php

function getAgeFromDate($date) {
    return date_diff(date_create($date), date_create('now'))->y;
}
