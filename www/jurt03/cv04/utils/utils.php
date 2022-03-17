<?php 

function fetchUsers(){
    $users = [];
    $userRecords = explode(PHP_EOL, file_get_contents(dirname(__DIR__) . '/users.db'));

    foreach ($userRecords as $userRecord){
        $user = explode(';',$userRecord);
            if (count($user) > 2){
                array_push($users,$user); 
            }
    }
    return $users;
}

function fetchUser($email){
    $users = fetchUsers();
    
    foreach($users as $user){
        if($user[1]==$email){
            return $user;
        }
    }
    return null;
}

function registerNewUser($name, $email, $password){

    $userRecord = implode(';',[$name,$email,$password]);
    file_put_contents(dirname(__DIR__) . '/users.db',$userRecord . PHP_EOL, FILE_APPEND);
    mail($email, 'Registration success notification',"Name: $name, Email: $email");
    
}


function authenticate($email, $password){
    $user = fetchUser($email);
    
    if(!$user) {
        return "User with email $email not found.";
    }
    if($password !== $user[2]){
        return 'Invalid password';
    }
    return true;
}

?>