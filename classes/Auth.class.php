<?php
declare(strict_types = 1);
class Auth extends Dbh{
    //signin
     protected function get_userPassword(string $email) {
        $query = "SELECT password FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
    
        if ($stmt->rowCount() == 1) {
           return $stmt->fetch();
        }
        else {
            return false;
        }
    }
    protected function get_userData(string $email) {
        $query = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();   
        $result = $stmt->fetch();
        return $result;
    }

    //signup


    protected function emailExists(string $email)
    {
        $query = "SELECT email FROM `users` WHERE email = :email";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result;

    }

    protected function register_user(string $email, string $firstName, string $password, string $lastName, string $telephone){
        $query = "INSERT INTO users (first_name, last_name, password, telephone, email) VALUES (:first_name,:last_name,:password,:telephone, :email)";
        $stmt = $this->connect()->prepare($query);
        $options = [
               'cost' => 12
        ];
        $hashedPwd = password_hash($password, PASSWORD_BCRYPT, $options);
        $stmt->bindParam(":first_name", $firstName);
        $stmt->bindParam(":last_name", $lastName);
        $stmt->bindParam(":telephone", $telephone);
        $stmt->bindParam(":password", $hashedPwd);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $stmt= null;
 }

}