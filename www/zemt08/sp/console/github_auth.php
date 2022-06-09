<?php
include("db.php");
include("../utils/utils_user.php");
$code = $_GET['code'];

if ($code == "") {
    header('Location: https://zkusebna.4fan.cz/sp/');
    exit;
}

$CLIENT_ID = "ad7aed5e4e3b7497802a";
$CLIENT_SECRET = "e7eb60443836b23ccda93cc5f0f8f857afda2fd2";
$URL = "https://github.com/login/oauth/access_token";

$postParams = [
    'client_id' => $CLIENT_ID,
    'client_secret' => $CLIENT_SECRET,
    'code' => $code
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $URL);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);

if ($data->access_token != "") {
    session_start();
    $_SESSION['access_token'] = $data->access_token;

    $URL_ACCESS_TOKEN = "https://api.github.com/user";

    $authHeader = "Authorization: token " . $data->access_token;
    $userAgentHeader = "User-Agent: Blogino";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $URL_ACCESS_TOKEN);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Accept: application/json', $authHeader, $userAgentHeader));
    $resp = curl_exec($curl);
    curl_close($curl);
    $userData = json_decode($resp);
    $_SESSION["username"] = $userData->login;
    $_SESSION["user_id"] = $userData->id;

    if (!checkUser($userData->login, $con)) {
        createUserFromGithub($userData->id, $userData->login, $userData->email, $con);
    }
    header('Location: https://zkusebna.4fan.cz/sp/');
    exit;
}
