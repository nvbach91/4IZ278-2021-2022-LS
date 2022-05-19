<?php
if (strlen($firstName) < 2) {
    array_push($errors, 'First name is too short');
}

if (strlen($lastName) < 2) {
    array_push($errors, 'Last name is too short');
}
