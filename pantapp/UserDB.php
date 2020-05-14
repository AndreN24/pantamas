<?php
class DatabaseCommunicator {

    //Adds user into database with speicifed values
    // does not add user if it already exists with userid in the database!
    function AddUserInDatabase($userid, $email, $name, $privileges, $rating, $comments){
        // collect value of input field


        $db = new SQLite3("DB/users.db");
        $checkIfUserExists = false;
        $sql = ("INSERT INTO users(name, email, userid, privileges, rating, comments) VALUES(:name , :email, :userid, :privileges, :rating, :comments)");//prepare stmt

        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':name', $name , SQLITE3_TEXT);
        $stmt ->bindParam(':email', $email , SQLITE3_TEXT);
        $stmt ->bindParam(':userid', $userid , SQLITE3_TEXT);
        $stmt ->bindParam(":privileges", $privileges, SQLITE3_TEXT);
        $stmt ->bindParam(":rating", $privileges, SQLITE3_FLOAT);
        $stmt ->bindParam(":comments", $comments, SQLITE3_TEXT);



        $statement = $db->prepare('SELECT * FROM users WHERE userid = :userid'); //check if user already exists
        $statement->bindValue(':userid', $userid);

        $result = $statement->execute();


        while ($row = $result->fetchArray()) {  //confirm user exists
            if ($row['userid'] == $userid)
            {
                $checkIfUserExists = true;
                echo"<h1>User already exists!</h1>";
                    break;
            }
        }

        if (!$checkIfUserExists){ // create user
            if ($stmt->execute()){
                $db->close();
                echo "<h1>Successfully added user!</h1><br>";
            }
        }
    }

    //adds a post to the database with the given values.
    function AddPostInDatabase($user, $picture, $coords, $status, $comment){
        $db = new SQLite3("DB/posts.db");

        $sql = ("INSERT INTO posts(user,comment , picture, coords, status) VALUES(:user ,:comment , :picture, :coords, :status)");//prepare stmt

        $stmt = $db->prepare($sql); //bind params
        $stmt ->bindParam(':user', $user , SQLITE3_TEXT);
        $stmt ->bindParam(':picture', $picture , SQLITE3_TEXT);
        $stmt ->bindParam(':comment', $comment , SQLITE3_TEXT);

        $stmt ->bindParam(':coords', $coords , SQLITE3_TEXT);
        $stmt ->bindParam(":status", $status, SQLITE3_TEXT);
        $result = $stmt->execute();
    }

    //Changes the status of postID to the desiredStatus, DESIREDSTATUS can be OPEN, CLOSED, TAKEN
    function ChangeStatusOfPost($postID, $desiredStatus){
        $db = new SQLite3("DB/posts.db");

        $sql = "UPDATE posts SET status = :status WHERE id = :id";

        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':status', $desiredStatus , SQLITE3_TEXT);
        $stmt ->bindParam(':id', $postID , SQLITE3_INTEGER);
        $stmt->execute();
    }

    function GetAllPosts(){
        $db = new SQLite3("DB/users.db");


        $results = $db->query('SELECT * FROM users'); //check if user already exists
        echo "<br>";

        while ($row = $results->fetchArray()) {
            var_dump($row);
            echo "<br>";
        }
        //echo var_dump($arr);

    }

    //changes a rating of a given user with the userid and gives the desiredrating 
    //desired rating is a float
    function ChangeRatingOfUser($userID, $desiredRating){

        $db = new SQLite3("DB/users.db");
        $sql = "UPDATE users SET rating = :rating WHERE userid = :userid";
        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':userid', $userID , SQLITE3_TEXT);
        $stmt ->bindParam(':rating', $desiredRating , SQLITE3_FLOAT);

        $stmt->execute();

    }
}
?>