<?php
//SLUZI KADA NESTO MENJAMO U BAZI/ ZA UPDEJTOVANJE I INSERTOVANJE U BAZU/ HANDLES USER INPUT
//Talks with Model class

include_once 'signup.classes.php';
class SignupContr extends Signup{
    //SVOJSTVA/PROPERTIES
    protected $username;
    protected $pwd;
    protected $pwdrepeat;
    protected $email;

    public function __construct($username, $pwd, $pwdrepeat, $email){  //Podaci iz zagrade su podaci koje uzimamo od korisnika
        $this->username = $username;      //PRAVIMO DA SU SVOJSTVA JEDNAKA PODACIMA OD KORISNIKA
        $this->pwd = $pwd;
        $this->pwdrepeat = $pwdrepeat;
        $this->email = $email;

    }
    public function signupUser(){
        if($this->emptyInput() == false){
            //echo "Empty input";
            error_log("Empty input detected.");
            header("location: ../index.php?error=emptyinputds");
            exit();
        }
        if($this->invalidUid() == false){
            error_log("Invalid username detected.");
            //echo "Invalid username";
            header("location: ../index.php?error=invalidusername");
            exit();
        }
        if($this->invalidEmail() == false){
            error_log("Invalid email detected.");
            //echo "Invalid email";
            header("location: ../index.php?error=invalidemail");
            exit();
        }
        if($this->passwordMatch() == false){
            //echo "Password doesn't match";
            header("location: ../index.php?error=passwordnotmatch");
            exit();
        }
        if($this->userExistsCheck() == false){
            //echo "Username already taken";
            header("location: ../index.php?error=usernametaken");
            exit();
        }

        $this->setUser($this->username, $this->pwd, $this->email);
        
    }
    private function emptyInput(){
        $result = '';
        if(empty($this->username) || empty($this->pwd) || empty($this->pwdrepeat) || empty($this->email)){
            $result = false;
        } 
        else {
            $result = true;
        }
        return $result;
    }
    private function invalidUid() {
        //$result = '';
        error_log("Checking username: " . $this->username);
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){ //Ako ima neki karakter sem ovih vraca gresku ili false
            //$result = true;
            error_log("Username invalid: " . $this->username);
            return false;
        }
        return true;
        //else {
            //$result = false;
        //}
        //return $result;
    }
    private function invalidEmail(){
        $result = '';
        error_log("Checking email: " . $this->email);
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)) //Ako email nije tacan vraca false
        {
            $result = false;
            error_log("Email invalid: " . $this->email);
            //return false;
        }
        //return true;
        else{
            $result = true;
        }
        return $result;
    }
    private function passwordMatch(){
        if($this->pwd !== $this->pwdrepeat)
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;
    }
    
    public function userExistsCheck(){
        $result = '';
        if(!$this->userExists($this->username, $this->email))
        {
            $result = false;
        }
        else {
            $result = true;
        }
        return $result;

    }
    public function fetchUserId($username) {
        $userId = $this->getUserId($username);
        return $userId[0]["user_id"];
    }
}
