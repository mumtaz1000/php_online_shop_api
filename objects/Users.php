<?php
include("../../config/database_handler.php");
class Users
{
    private $database_connection;
    private $user_id;
    public $username;
    private $user_email;
    private $user_token;
    private $password;
    function __construct($db)
    {
        $this->database_connection = $db;
    }
    function SignUpUser($username_IN, $user_email_IN, $user_password_IN)
    {
        $error = new stdClass();
        if (!empty($username_IN) && !empty($user_email_IN) && !empty($user_password_IN)) {
            $sql = "SELECT id FROM user WHERE name=:username_IN OR email=:email_IN";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":username_IN", $username_IN);
            $statement->bindParam(":email_IN", $user_email_IN);
            if (!$statement->execute()) {
                $error->message = "Could not execute query!";
                $error->code = "0000";
                print_r(json_encode($error));
                die();
            }
            $num_row = $statement->rowCount();
            if ($num_row > 0) {
                $error->message = "The user is already registered";
                $error->code = "0010";
                print_r(json_encode($error));
                die();
            }
            $sql = "INSERT INTO user (name, email, password) VALUES(:username_IN,:email_IN,:password_IN)";
            $statement = $this->database_connection->prepare($sql);
            $statement->bindParam(":username_IN", $username_IN);
            $statement->bindParam(":email_IN", $user_email_IN);
            $statement->bindParam(":password_IN", $user_password_IN);
            if (!$statement->execute()) {
                $error->message = "Could not execute query!";
                $error->code = "0000";
                print_r(json_encode($error));
                die();
            }
            $this->username = $username_IN;
            $this->user_email = $user_email_IN;
            echo "Username:$this->username and Email:$this->user_email is registered successfully!";
        } else {
            $error = new stdClass();
            $error->message = "All arguments needs a value";
            $error->code = "0001";
            //echo "";
            print_r(json_encode($error));
            die();
        }
    }
    function Login($username_IN, $password_IN)
    {
        $sql = "SELECT id, name, email, role FROM user WHERE name=:username_IN AND password=:password_IN";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":username_IN", $username_IN);
        $statement->bindParam(":password_IN", $password_IN);
        $statement->execute();
        $this->username = $username_IN;
        if ($statement->rowCount() == 1) {
            $row = $statement->fetch();
            return $this->CreateToken($row['id'], $row['name']);
        } else {
            echo "No $this->username found. You need to signup!";
            die();
        }
    }
    function CreateToken($id, $username)
    {
        $checked_token = $this->CheckToken($id);
        if ($checked_token != false) {
            return $checked_token;
        }
        $token = md5(time() . $id . $username);
        $sql = "INSERT INTO sessions (user_id, token, last_used) VALUES (:user_id_IN,:token_IN,:last_used_IN)";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":user_id_IN", $id);
        $statement->bindParam(":token_IN", $token);
        $time = time();
        $statement->bindParam(":last_used_IN", $time);
        $statement->execute();
        return $token;
    }
    function CheckToken($id)
    {
        $sql = "SELECT token, last_used FROM sessions WHERE user_id=:user_id_IN AND last_used> :active_time_IN LIMIT 1";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":user_id_IN", $id);
        $active_time = time() - 3600;
        $statement->bindParam(":active_time_IN", $active_time);
        $statement->execute();
        $return = $statement->fetch();
        if (isset($return['token'])) {
            return $return['token'];
        } else {
            return false;
        }
    }
    function isTokenValid($token)
    {
        $sql = "SELECT token, last_used FROM sessions WHERE token=:token_IN AND last_used>:active_time_IN LIMIT 1";
        $statement = $this->database_connection->prepare($sql);
        $statement->bindParam(":token_IN", $token);
        $active_time = time() - 3600;
        $statement->bindParam(":active_time_IN", $active_time);
        $statement->execute();
        $return = $statement->fetch();
        if (isset($return['token'])) {
            return true;
        } else {
            return false;
        }
    }
    function UpdateToken($token)
    {
        $sql = "UPDATE sessions SET last_used=:last_used_IN WHERE token=:token_IN";
        $statement = $this->database_connection->prepare($sql);
        $time = time();
        $statement->bindParam(":last_used_IN", $time);
        $statement->bindParam(":token_IN", $token);
        $statement->execute();
    }
}
