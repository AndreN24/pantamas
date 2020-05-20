<?php

$dbdata = new DatabaseCommunicator();
if ($_GET["function"] ="GetPosts"){
    $dbdata->GetAllPosts();
}

class DatabaseCommunicator {

    //Adds user into database with speicifed values
    // does not add user if it already exists with userid in the database!
    function AddUserInDatabase($userid, $email, $name, $privileges, $rating, $comments){

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

        $result = $statement->query();


        while ($row = $result->fetchArray()) {  //confirm user exists
            if ($row['privileges'] == "Banned"){ //if users privileges == banned the user cannot create a new account with this facebook account//the same userid
                echo "User is Banned!"; 
                $checkIfUserExists = true;
                break;//break out of loop 
            }
            if ($row['userid'] == $userid) //if userID already exists in database prevent from creating new user
            {
                $checkIfUserExists = true;
                echo"User already exists!";
                break;
            }
        }

        if (!$checkIfUserExists){ // create user and finish statement
            if ($stmt->execute()){
                $db->close();
                echo "Successfully added user!";
            }
        }
    }

    //makes the user not able to post anymore
    //DOES NOT REMOVE USER FROM DATABASE since then it would be possible to just to register again.
    function BanUser($use rID){
        $db = new SQLite3("DB/users.db");

        $BannedPrivilege = "Banned"
        $sql = "UPDATE users SET privileges = :privileges WHERE id = :userID";

        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':privileges', $BannedPrivilege , SQLITE3_TEXT);
        $stmt ->bindParam(':userID', $userID , SQLITE3_INTEGER);
        if ($stmt->execute()){
            echo json_encode("User: ". $userID . "Successfully banned");
        }
        else{
            echo json_encode("Failed to ban user");
        }
    }

    //adds a post to the database with the given values.
    function AddPostInDatabase($user, $picture, $long, $lat, $status, $comment){
        $db = new SQLite3("DB/posts.db");

        $sql = ("INSERT INTO posts(user,comment , picture, lat, long, status) VALUES(:user ,:comment , :picture, :lat , :long , :status)");//prepare stmt

        $stmt = $db->prepare($sql); //bind params
        $stmt ->bindParam(':user', $user , SQLITE3_TEXT);
        $stmt ->bindParam(':picture', $picture , SQLITE3_TEXT);
        $stmt ->bindParam(':comment', $comment , SQLITE3_TEXT);
        $stmt ->bindParam(':long', $long , SQLITE3_FLOAT);
        $stmt ->bindParam(':lat', $lat , SQLITE3_FLOAT);
        $stmt ->bindParam(":status", $status, SQLITE3_TEXT);
        if($stmt->execute()){
        echo json_encode("Successfully added post!");
        }
        else {
            echo json_encode("Failed to add post!");
        }
    }

    //Changes the status of postID to the desiredStatus, DESIREDSTATUS can be OPEN, CLOSED, TAKEN
    function ChangeStatusOfPost($postID, $desiredStatus){
        $db = new SQLite3("DB/posts.db");

        $sql = "UPDATE posts SET status = :status WHERE id = :id";

        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':status', $desiredStatus , SQLITE3_TEXT);
        $stmt ->bindParam(':id', $postID , SQLITE3_INTEGER);
        if($stmt->execute()){
            echo json_encode("Successfully changed status of post: " .$postID " to: ".$desiredStatus);
            }
            else {
                echo json_encode("Failed to change post status!");
            }
    }

    //Gets all posts with the status "OPEN"
    function GetAllPosts(){

        $db = new SQLite3("DB/posts.db");


        $results = $db->query('SELECT * FROM posts WHERE status = "OPEN"'); //check if user already exists
         
        $data = array();
        
        while ($row = $results->fetchArray()) {
            array_push($data, $row);
        }
        echo json_encode($data);        

    }

    //Adds a comment to the select user 
    function AddCommentsToUser($userID, $comments){
        $db = new SQLite3("DB/users.db");


        $statement = $db->prepare('SELECT * FROM users WHERE userid = :userid'); //check if user already exists

        $statement->bindValue(':userid', $userID);

        $result = $statement->query();

        
        while ($row = $result->fetchArray()) {  //gets comments from database and appends it with the incomming comment
            $comments = $row['comments'] .$comments;
        }


        $sql = "UPDATE users SET comments = :comments WHERE id = :id";

        $stmt = $db->prepare($sql); //bind params
        $stmt ->bindParam(':comments', $comments , SQLITE3_TEXT);
        $stmt ->bindParam(':id', $userID , SQLITE3_INTEGER);
        if($stmt->execute()){
            echo json_encode("Successfully added comment to user: ".$userID);
        }
        else{
            echo json_encode("Failed to add comment");
        }
    }

    //changes a rating of a given user with the userid and gives the desiredrating 
    //desired rating is a float
    function ChangeRatingOfUser($userID, $desiredRating){

        $db = new SQLite3("DB/users.db");
        $sql = "UPDATE users SET rating = :rating WHERE userid = :userid";
        $stmt = $db-> prepare ($sql); //bind params
        $stmt ->bindParam(':userid', $userID , SQLITE3_TEXT);
        $stmt ->bindParam(':rating', $desiredRating , SQLITE3_FLOAT);

        if($stmt->execute()){
            echo json_encode("Successfully changed rating of user: ".$userID);
        }
        else{
            echo json_encode("Failed to change rating");
        }

    }
}
?>