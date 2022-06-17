<?php

require __DIR__ . '/util/is-admin.php';

$id = $_GET['id'];


require_once __DIR__ . '/db/event-db.php';

$eventDB = new EventDB();
$existingUser = $eventDB->deleteRow($id);


header('Location: events-manage.php');
exit();
