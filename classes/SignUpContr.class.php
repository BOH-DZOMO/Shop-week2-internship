<?php
declare(strict_types = 1);
require_once "../vendor/autoload.php";

class SignUpContr extends Auth
{
    private $firstName;
    private $lastName;
    private $telephone;
    private $pwd;
    private $pwd_confirm;
    private $email;
    private $signupErrors = [];

    public function __construct($firstName=null, $lastName=null, $pwd=null, $pwd_confirm=null, $email=null, $telephone=null)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->pwd = $pwd;
        $this->pwd_confirm = $pwd_confirm;
        $this->email = $email;
        $this->telephone = $telephone;
    }
    public function signupUser()
    {

        if ($this->emailExists($this->email) === 1) {
            $this->signupErrors["email_used"] = "Invalid Input";
        }
        if ($this->pwdMatch() == false) {
            $this->signupErrors["password_mismatch"] = "Password Mismatch";
        }
        if ($this->is_email_invalid() == true) {
            $this->signupErrors["invalid_email"] = "Invalid email used!";
        }


        if ($this->signupErrors) {
            $_SESSION["errors_signup"] = $this->signupErrors;
            header("location: ../index.php?signup=failed");
            exit();
        }

        $this->register_user($this->email,  $this->firstName, $this->pwd, $this->lastName, $this->telephone);
        header("location: ../index.php?signup=success");
    }

    public function factoryCreate(int $num){
        $faker = Faker\Factory::create();
        for ($i=0; $i < $num; $i++) { 
            $this->register_user($faker->freeEmail,$faker->firstName,$faker->password(8),$faker->lastName,$faker->unique()->numerify("+237 677######"));
        }
    }


    private function is_email_invalid()
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            return true;
        } else {
            return false;
        }
    }
    private function pwdMatch()
    {
        if ($this->pwd === $this->pwd_confirm) {
            return true;
        } else {
            return false;
        }
    }
}
