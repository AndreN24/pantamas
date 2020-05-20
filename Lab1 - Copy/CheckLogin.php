<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    $unique_salt = $row['salt']; //get the salt
    $userPassword = $row['password']; // get password of user

    $checkHash = sha1($unique_salt . $password); // get hash 
    

        if ($checkHash == $userPassword) //check if passwords are equal
        {
            echo"Login successful!";
            session_start();

            $_SESSION['email'] = $email;
            header("Location: index.php");


        }
        else{ //password is wrong
            echo "Wrong username or password!";
        }
    }
    else{
        echo "Wrong username or password!";

    }
}
    
?>
<!DOCTYPE html>
<html>
    <body>
        <form action="login.php">
            <input type="submit"  value="Go back" id="submit">

        </form>
    </body>
</html>
