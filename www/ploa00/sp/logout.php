<?php

require __DIR__ . '/utils/logged.php';

session_destroy();

header('Location: index.php');