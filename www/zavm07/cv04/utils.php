<?php
function getUsers($email){
    $userRecords = explode("\n",file_get_contents('users.db'));
    $users = [];
    foreach ($userRecords as $userRecord){
        $user = explode(";",$userRecord);
        if ($user[2]===$email){
            return $user;
        }
        array_push($users,$user);
    }
    return $users;
};
?>