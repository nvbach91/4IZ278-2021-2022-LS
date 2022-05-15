<?php

require __DIR__ . '/util/is-logged.php';

session_destroy();

header('Location: index.php');
