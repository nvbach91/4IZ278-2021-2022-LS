<?php

require "../database/database.php";
require "../database/usersdb.php";
require "../database/usertokensdb.php";

$tokensDb = new UserTokensDB();

$token = bin2hex(random_bytes(16));

var_dump($token);

$expire = date('Y-m-d H:i:s', strtotime('+ 30 days'));
$month = time() + 3600 * 24 * 30;
var_dump($month);
echo strtotime($expire);

if (isset($_COOKIE["token"])) {
    echo "token set" . $_COOKIE["token"];
}
else echo "token not set";

echo "\n\n\n";
$row = $tokensDb->fetchById(1)[0];
var_dump($row);

?>