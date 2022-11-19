<?php
    require 'config.php';
    function connect(){
        $mysqli = new mysqli(SERVER,USERNAME,PASSWORD,DB);
        if($mysqli->connect_errno!=0){
            $error = $mysqli->connect_error;
            $error_date = date("F j, Y, g:i a");
            $message = "{$error} | {$error_date} \r\n";
            file_put_contents("db-log.txt",$message,FILE_APPEND);
            return false;
        }
        else {
            return $mysqli;
        }
    }
    function registerUser($email, $username,$phno,$password,$address){
        $mysqli = connect();
        $args = func_get_args();

        $args = array_map(function($value){
            return trim($value);
        },$args);

        foreach($args as $value){
            if(empty($value)){
                return "All fields are required";
            }
        }

        $stmt = $mysqli->prepare("SELECT * FROM users WHERE email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($data != null){
            return "Email already exists";
        }

        $stmt = $mysqli->prepare("SELECT * FROM users WHERE username=?");
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();
        if($data != null){
            return "Username already exists";
        }

        $hashed_password = password_hash($password,PASSWORD_DEFAULT);

        $stmt = $mysqli->prepare("INSERT INTO users (username,phno,password,email,address) VALUES (?,?,?,?,?)");
        $stmt->bind_param("sssss",$username,$phno,$hashed_password,$email,$address);
        $stmt->execute();
        if($stmt->affected_rows == 1){
            return "Success";
        }
        else {
            return "Something went wrong";
        }
    }
    function loginUser($username, $password){
        $mysqli = connect();
        $username = trim($username);
        $password = trim($password);

        $sql = "SELECT username,password FROM users WHERE username=?";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("s",$username);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($data == null){
            return "Username does not exist";
        }
        if(password_verify($password,$data['password']) == TRUE){
            $_SESSION['user'] = $username;
            header("location: account.php");
            exit();
        }
        else {
            return "Incorrect password";
        }
    }
    function logoutUser(){
        session_destroy();
        header("location: login.php");
        exit();
    }
    function passwordReset($email){
        $mysqli = connect();
        $email = trim($email);

        $stmt = $mysqli->prepare("SELECT email FROM users WHERE email=?");
        $stmt->bind_param("s",$email);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = $result->fetch_assoc();

        if($data == null){
            return "Email does not exist";
        }

        $str = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $password_length = 8;
        $shuffled_str = str_shuffle($str);
        $new_password = substr($shuffled_str,0,$password_length);

        $subject = "Password Recovery";
        $body = "You can now login with your new password: "."\r\n".$new_password;
        $headers = "From: 200701286@rajalakshmi.edu.in"."\r\n";

        $send = mail($email,$subject,$body,$headers);
        if($send == TRUE){
            $hashed_password = password_hash($new_password,PASSWORD_DEFAULT);
            $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE email=?");
            $stmt->bind_param("ss",$hashed_password,$email);
            $stmt->execute();
            if($stmt->affected_rows == 1){
                return "Success";
            }
            else {
                return "Connection Error. Please try again";
            }
        }
        else {
            return "Email not sent. Try again later";
        }
    }
?>