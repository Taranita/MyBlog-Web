<?php
/** Created by me */

include "../auth/db.php";


function signUp($user, $email, $password, $created_Date)
{
    global $con;
    $USER_NAME = mysqli_real_escape_string($con, $user);
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);

    $PASSWORD = password_hash($USER_PASSWORD, PASSWORD_DEFAULT);
    $query = "INSERT INTO `users`(`name`, `email`, `password`, `created_date`) VALUES ('$USER_NAME', '$USER_EMAIL', '$PASSWORD', '$created_Date')";
  
    $result = mysqli_query($con, $query);
    if(!$result)
    {
        die("Query failed " . mysqli_error($con));
        //return "Query failed";
    }
    else
    {
        return $result;
    }
}

function logIn($email, $password)
{
    global $con;
    
    $USER_EMAIL = mysqli_real_escape_string($con, $email);
    $USER_PASSWORD = mysqli_real_escape_string($con, $password);

    $query = "SELECT * FROM users WHERE email = '$USER_EMAIL'";
    $result = mysqli_query($con, $query);
    if($result){
        $rowcount = mysqli_num_rows($result);
        if($rowcount == 1){
            $user = mysqli_fetch_array($result);
            $PASSWORD = $user["password"];

            if(password_verify($USER_PASSWORD, $PASSWORD)){
                return true;
            }else{
                return "Password does not match.";
            }
        }
    }else{
        die("Query failed " . mysqli_error($con));
        //return "Query failed";
    }

}


function isEmailExist($email){
    global $con;

    $query = "SELECT email from users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if($result){
        $rows = mysqli_num_rows($result);
        if($rows>=1){
            return true;
        }else{
            return false;
        }
    
    }else{
        die("Query failed " . mysqli_error($con));
        //return "Query failed";
    }
}

function getUserDetailByEmail($email){
    global $con;

    $query = "SELECT * from users WHERE email = '$email'";
    $result = mysqli_query($con, $query);
    if($result){
        return $result;    
    }else{
        return false;
    }
}