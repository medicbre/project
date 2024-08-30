<?php
// SLUZI KADA NESTO MENJAMO U BAZI/ ZA UPDEJTOVANJE I INSERTOVANJE U BAZU/ HANDLES USER INPUT
// Talks with Model class

include_once 'login.classes.php';
class LoginContr extends Login {
    // SVOJSTVA/PROPERTIES
    protected $username;
    protected $pwd;

    public function __construct($username, $pwd)
    {  // Podaci iz zagrade su podaci koje uzimamo od korisnika
        $this->username = $username;      // PRAVIMO DA SU SVOJSTVA JEDNAKA PODACIMA OD KORISNIKA
        $this->pwd = $pwd;
        error_log("Username: " . $username);
        error_log("Password: " . $pwd);

        //error_log($username);
    }
    public function loginUser() {
        if($this->emptyInput() === false) {
            //echo "Empty input";
            header("location: ../index.php?error=emptyinputdsadsa");
            exit(); // Prekida izvrsenje skripte nakon redirekcije
        }

        $this->getUser($this->username, $this->pwd);
    }
    private function emptyInput(){
        $result = '';

        //error_log($this->username, $this->pwd);

        // Proveravamo da li su polja prazna
        if(empty($this->username) || empty($this->pwd)){
            $result = true;
        } 

        error_log("Empty input check result: " . ($result ? 'true' : 'false'));

        return $result;
    }
}