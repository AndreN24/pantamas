<?php
session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['email'])) {
        $search =  $_POST['fsearch'];
        $db = new SQLite3("DB/comments.db");

        if (!empty($search)){
            echo json_encode(GetComments($db, $search));
        }
        else{
        AddDatabaseEntry($db);
        }
    }
    else{
        header("Location: index.php");
    }

 


    function AddDatabaseEntry($db){
        // collect value of input field

        $name = $_POST['fname'];
        $email = $_SESSION['email'];
        $comment = $_POST['fcomment'];

        if (empty(trim($_POST['image'])))
        {
            $image = "https://i.stack.imgur.com/l60Hf.png";
        }
        else{
            $image = $_POST['image'];

        }

        




        if (!empty(trim($name)) && !empty(trim($email)) && !empty(trim(($comment)))) {
            if (strpos($email, '@') !== false && strpos($email, '.') !== false) {
                //$sql = ("INSERT INTO 'comments'(email, names, comment) VALUES (:email, :name, :comment)");
                //$db->exec("CREATE TABLE comments(id INTEGER PRIMARY KEY,email TEXT, names TEXT, comment TEXT, image TEXT)");

                $sql = " INSERT INTO comments (email, names, comment, image) VALUES (:email, :names, :comment, :image)";
                $stmt = $db-> prepare ($sql); //H¨ar f¨o rbereds v˚ar query
                $stmt ->bindParam (':email', $email , SQLITE3_TEXT );
                $stmt ->bindParam (':names', $name , SQLITE3_TEXT );
                $stmt ->bindParam (':comment', $comment , SQLITE3_TEXT );
                $stmt ->bindParam (':image', $image , SQLITE3_TEXT );

                if ($stmt->execute()){
                    echo json_encode(GetComments($db, ""));
                    
                    exit;

                }
            }
            else{
                echo json_encode("ERROR: email does not contain proper characters!");
            }

        } else {
            echo json_encode("ERROR: Name, email or comment is empty!");                        
        }   
    }

    function GetComments($db, $search){
        $data = array();
        if (empty($search))
        {
        $result = $db->query("SELECT * FROM comments");
        }
        else{
            $stmt = $db->prepare (" SELECT * FROM 'comments' WHERE comment LIKE :search ORDER BY id");
            $stmt->bindValue(':search', "%" . $search . "%", SQLITE3_TEXT ) ;
            $result = $stmt->execute();
            
        }

        while ($row = $result->fetchArray()) {

            array_push($data, $row);
            
        }
        return $data;
    }

?>