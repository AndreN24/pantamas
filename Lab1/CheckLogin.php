<?php

include "functions.php";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && !isset($_SESSION['email'])) {
        CheckLogin();
    }
    else{
        header("Location: index.php");
    }




    function CheckLogin(){
    // collect value of input field

    $password = $_POST['fpassword'];
    $email = $_POST['femail'];

    $db = new SQLite3("DB/users.db");
    $checkIfUserExists = false;


    $statement = $db->prepare('SELECT * FROM users WHERE email = :email');  // get email of selected user
    $statement->bindValue(':email', $email); // bind
    $result = $statement->execute();
    
    if ($row = $result->fetchArray()){ //get the row of the table. If this returns false user does not exist

        $salt = $row['salt']; //get the salt
        $userPassword = $row['password']; // get password of user
        
        if (checkPassword($salt, $userPassword, $password)){
            session_start();

            $_SESSION['email'] = $email;
            $_SESSION['id'] = $row['id'];
            echo ("Succeessfully logged in");
            }
            else{ //password is wrong
                echo ("Wrong username or password!");
            }
        }
    else{
        echo ("Wrong username or password!");

    }
}

    
?>
