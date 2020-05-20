<?php

include 'functions.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['email'])) {
    if (isset($_POST['fnewpassword']))
    {
    ChangePassword();
    }
    else if (isset($_POST['image'])){
        ChangeImage();
    }
}
else{
    header("Location: index.php");
}


    function ChangePassword(){
        $db = new SQLite3("DB/users.db");

        $newPassword = $_POST['fnewpassword'];
        $email = $_POST['femail'];
        $oldPassword = $_POST['foldpassword'];

        $statement = $db->prepare('SELECT * FROM users WHERE id = :id');  // get email of selected user
        $statement->bindValue(':id', $_SESSION['id']); // bind
        $result = $statement->execute();

        if ($row = $result->fetchArray()){ //get the row of the table. If this returns false user does not exist

            $salt = $row['salt']; //get the salt
            $userPassword = $row['password']; // get password of user

                if (checkPassword($salt, $userPassword, $oldPassword)){

                    $sql = "UPDATE users SET password = :password AND email = :email WHERE id = :id"; //change email and password
                    $password = sha1($salt . $newPassword);

                    $stmt = $db-> prepare ($sql); //bind params
                    $stmt ->bindParam(':password', $password , SQLITE3_TEXT);
                    $stmt ->bindParam(':email', $email , SQLITE3_TEXT);
                    $stmt ->bindParam(':id', $_SESSION['id'] , SQLITE3_INTEGER);
                    $stmt->execute();

                    echo json_encode("Sucessfully changed password and email!");
                }
                else{
                    echo json_encode("Incorrect password!");
                }
            }
        else{
            echo json_encode("This should never happen");
        }
    }

    function ChangeImage(){
        
        $image = $_POST['image'];
        $sql = "UPDATE users SET image = :image WHERE id = :id"; //change email and password
        $password = sha1($salt . $newPassword);

        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':image', $image , SQLITE3_TEXT);
        $stmt ->bindParam(':id', $_SESSION['id'] , SQLITE3_INTEGER);
        $stmt->execute();

        echo $error;
    }

?>