<?php
use LDAP\Result;
//SLUZI KADA NESTO MENJAMO U BAZI/ ZA UPDEJTOVANJE I INSERTOVANJE U BAZU/ HANDLES USER INPUT
//Talks with Model class

class ProfileinfoContr extends Profileinfo {

    protected $userid;
    protected $username;

    public function __construct($userid, $username){
        $this->userid = $userid;
        $this->username = $username;
    }

    public function defaultProfileInfo() {  //DEFAULT OPIS PROFILA NAKON REGISTRACIJE
        $profileAbout = "Tell people about yourself!";
        $profileTitle = "Hi! I am " . $this->username;
        $profileIntro = "Welcome to my profile page! Soon I'll be able to tell you more about myself!";
        $this->setProfileInfo($profileAbout, $profileTitle, $profileIntro, $this->userid);
    }

    public function updateProfileInfo($about, $introTitle, $introText) {
        //Error handlers
        if($this->emptyInputCheck($about, $introTitle, $introText) == true) { //Proveravamo da li vraca true, ako vraca imamo gresku
            header("location: ../profilesettings.php?error=emptyinput"); //Nemas stranicu
            exit();
        }
            //Update profile info koji uvek ide na kraju
            $this->setNewProfileInfo($about, $introTitle, $introText, $this->userid);  //kreiramo profil usera

    }

    private function emptyInputCheck($about, $introTitle, $introText) { //Ako je empty vracamo true
        $result = "";
        if(empty($about) || empty($introTitle) || empty($introText)) {
            $result = true;
        }
        else {
            $result = false;
        }
        return $result;
    }
    
}