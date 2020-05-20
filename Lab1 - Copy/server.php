<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        AddDatabaseEntry();
    }
    else{
        header("Location: index.php");
    }




    function AddDatabaseEntry(){
                // collect value of input field

                $name = $_POST['fname'];
                $email = $_POST['femail'];
                $comment = $_POST['fcomment'];
                
                $db = new SQLite3("DB/comments.db");
        
        
        
                if (!empty(trim($name)) && !empty(trim($email)) && !empty(trim(($comment)))) {
                    if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
                        //$sql = ("INSERT INTO 'comments'(email, names, comment) VALUES (:email, :name, :comment)");
                        $sql = " INSERT INTO 'comments' ('email', 'names', 'comment') VALUES (:email, :name, :comment)";
                        $stmt = $db-> prepare ($sql); //H¨ar f¨o rbereds v˚ar query
                        $stmt ->bindParam (':email', $email , SQLITE3_TEXT );
                        $stmt ->bindParam (':name', $name , SQLITE3_TEXT );
                        $stmt ->bindParam (':comment', $comment , SQLITE3_TEXT );
                        if ($stmt->execute()){
                            $db->close();
                        }


                        //$db->exec("INSERT INTO comments(email, names, comment) VALUES ('$email', '$name', '$comment')");
                        header("Location: index.php");

                        exit();
                    }
                    else{
                        echo "ERROR: email does not contain proper characters!";
                    }
        
                } else {
                    echo "ERROR: Name, email or comment is empty!";                        
                }

                
    }

?>