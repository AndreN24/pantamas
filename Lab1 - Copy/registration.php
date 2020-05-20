<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        AddDatabaseEntry();
    }
    else{
        header("Location: index.php");
    }




    function AddDatabaseEntry(){
                // collect value of input field

                $password = $_POST['fpassword'];
                $email = $_POST['femail'];
                
                $db = new SQLite3("DB/users.db");
                $checkIfUserExists = false;
        
        
                if (!empty(trim($password)) && !empty(trim($email))) {
                    if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
                        $unique_salt = unique_salt();
                        $sql = " INSERT INTO 'users' ('email', 'password', 'salt') VALUES (:email, :password, :salt)";
                        $hash = sha1($unique_salt . $password);
                        $stmt = $db-> prepare ($sql); //H¨ar f¨o rbereds v˚ar query
                        $stmt ->bindParam(':email', $email , SQLITE3_TEXT );
                        $stmt ->bindParam(':password', $hash , SQLITE3_TEXT );
                        $stmt ->bindParam(':salt', $unique_salt , SQLITE3_TEXT );


                        $statement = $db->prepare('SELECT * FROM users WHERE email = :email');
                        $statement->bindValue(':email', $email);

                        $result = $statement->execute();


                        while ($row = $result->fetchArray()) {
                            if ($row['email'] == $email)
                            {
                                $checkIfUserExists = true;
                                echo"<h1>User already exists!</h1>";
                                 break;
                            }
                        }
                        if (!$checkIfUserExists){
                            if ($stmt->execute()){
                                $db->close();
                                echo "<h1>Successfully added user!</h1><br>";
                                echo "Your login information is: <br>";
                                echo "Email: $email Password: $password";

                            }
                        }
                    }
                    else{
                        echo "REGISTRATION ERROR: email does not contain proper characters!";
                    }
        
                } else {
                    echo "REGISTRATION ERROR: Email or password is empty! ";                        
                }

                
    }

    function unique_salt() {
 
        return substr(sha1(mt_rand()),0,22);
    }

?>
<!DOCTYPE html>
<html>

        <head>
        <link rel="stylesheet" type="text/css" href="style.css">

        <form action="login.php">
            <input type="submit" value="Go to login" id="submit">
            
           
            </form>
            <form action="register.php">
            <input type="submit" value="Go back register form" id="submit">
            
           
            </form>
            
          </head>


</html>