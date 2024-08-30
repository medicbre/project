<?php 

//echo realpath("../vendor/autoload.php");
require dirname("../vendor/autoload.php");
require "dbh.class.php";
require_once "passwordReset-model.classes.php";


class PasswordResetContr extends PasswordReset {
    protected $selector;
    protected $validator;
    protected $password;
    protected $passwordRepeat;
    private $model;
    

    public function __construct()
    {
        $this->model = new PasswordReset;
    }

    public function setRequestData($selector, $validator, $password, $passwordRepeat)
     //klasa PasswordResetController. U ovom slučaju, ona omogućava da se podaci dobijeni iz korisničkog unosa postave u zaštićena svojstva klase.
    {
        $this->selector = $selector;
        $this->validator = $validator;
        $this->password = $password;
        $this->passwordRepeat = $passwordRepeat;
    }

    public function resetPassword()
    {
        if (empty($this->password) || empty($this->passwordRepeat))
        {
            header("Location: ../index1.php?resetFailed-start-over");
            exit();
        }
        if ($this->password !== $this->passwordRepeat)
        {
            header("Location: ../index1.php?pwdNotSame-start-over");
            exit();
        }
        $currentDate = date("U");
        $tokenData = $this->model->getTokenData($this->selector, $currentDate);
        
        if (!$tokenData) {
            throw new Exception("SQL statement preparation failed.");
        }

        //Usporedjujemo token iz forme sa onim iz baze
        $tokenBin = hex2bin($this->validator);
        if (!password_verify($tokenBin, $tokenData["pwdResetToken"])) {
            header("Location: ../index1.php?Resumbit-request");
            exit();
        }

        $user = $this->model->getUserByEmail($tokenData['pwdResetEmail']);
        if (!$user) {
            header("Location: ../index1.php?ThereWasError");
            exit();
        }

        $newPwdHash = password_hash($this->password, PASSWORD_DEFAULT);
        if ($this->model->updatePassword($newPwdHash, $user['users_email'])) {
            $this->model->deleteOldRequests($user['users_email']);
            header("Location: ../signup.php?newpwd=passwordupdated");
        }
        else {
            header("Location: ../index1.php?ThereWasError");
        }
    }

}