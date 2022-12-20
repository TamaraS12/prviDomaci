<?php

class User{

    public $id;
    public $username;
    public $password;

    public function __construct($id=null,$username=null,$password=null)
    {
        $this->id= $id;
        $this->username= $username;
        $this->password= $password;
    }

    public static function logInUser($usr, mysqli $conn){

        $query= "SELECT * FROM korisnik WHERE korisnicko_ime= '$usr->username' and lozinka= '$usr->password'";

        return $conn->query($query);
    }
}

?>