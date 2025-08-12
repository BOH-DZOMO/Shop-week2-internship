<?php
class SignInContr extends Auth
{
    private $email;
    private $pwd;
    private $signInErrors = [];

    public function __construct($email, $pwd)
    {
        $this->email = $email;
        $this->pwd = $pwd;
    }

    public function loginUser()
    {
        if ($this->get_userPassword($this->email) == false || !password_verify($this->pwd, $this->get_userPassword($this->email)["password"])) {
            $this->signInErrors["invalid_username"] = "Invalid Credentials";
        } 

        //review
        if ($this->signInErrors) {
            $_SESSION["errors_signin"] = $this->signInErrors;
            header("location: ../index.php?signin=failed2");
            exit();
        }


        $result = $this->get_userData($this->email);
        $_SESSION["user_id"] = $result["id"];
        // $_SESSION["user_username"] = htmlspecialchars($result["username"]);
        header("location: ../pages/first-day-x.php?signin=success");
        exit();
    }
}
