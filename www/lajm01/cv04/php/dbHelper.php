<?php 
class User{
    public $name;
    public $gender;
    public $email;
    public $phone;
    public $avatar;
    public $password;

    function __construct($array)
    {
        $this->name = $array[0];
        $this->gender = $array[1];
        $this->email = $array[2] ?? "";
        $this->phone = $array[3] ?? "";
        $this->avatar = $array[4] ?? "";
        $this->password = $array[5] ?? "";
    }

    function toArray(){
        return [$this->name,$this->gender,$this->email,$this->phone,$this->avatar,$this->password];
    }
}

class DBHelper{
    private $dbName = __DIR__.DIRECTORY_SEPARATOR."users.csv";

    function saveUser($user){
        if($this->getUser($user->email) !== null){
            return "User is not unique";
        }

        $user->password = password_hash($user->password, PASSWORD_DEFAULT);
        
        $fp = fopen($this->dbName, 'a');
        $res = fputcsv($fp, $user->toArray());

        fclose($fp);
        return $res == true ? true : "Some err happened";
    }

    function getUsers(){
        $arr = [];

        if (($handle = fopen($this->dbName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $user = new User($data);
                array_push($arr, $user);
            }
            fclose($handle);
        }

        return $arr;
    }

    function getUser($email){
        if (($handle = fopen($this->dbName, "r")) !== FALSE) {
            while (($data = fgetcsv($handle)) !== FALSE) {
                $user = new User($data);
                if($user->email === $email){
                    fclose($handle);
                    return $data;
                }
            }
            fclose($handle);
        }
        return null;
    }

    function tryLogin($email, $password){
        $row = $this->getUser($email);
        if($row === null)
            return "User not found";

        $user = new User($row);
        if(password_verify($password, $user->password))
            return true;
        else
            return "Bad password";
    }
}
?>