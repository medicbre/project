<?php
//SLUZI DA FETCHUJE/POKAZE PODATKE IZ BAZE
//Talks directly with Model class

class ProfileinfoView extends Profileinfo {

    public function fetchAbout($userid) //Ispisujemo podatke iz baze
    {
        $profileInfo = $this->getProfileInfo($userid);

        if ($profileInfo === null) {
            echo "Error fetching profile information.";
        } else {
            echo $profileInfo[0]["profiles_about"];
        }
    }

    public function fetchTitle($userid)
    {
        $profileInfo = $this->getProfileInfo($userid);
        
        if ($profileInfo === null) {
            echo "Error fetching profile information.";
        } else {
            echo $profileInfo[0]["profiles_introtitle"];
        }
    }

    public function fetchText($userid)
    {
        $profileInfo = $this->getProfileInfo($userid);
        
        echo $profileInfo[0]["profiles_introtext"];
    }

    
}