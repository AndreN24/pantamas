<?php
include "UserDB.php";

echo $_GET["name"] . "<br>";
echo $_GET["id"] . "<br>";
echo $_GET["email"];

$db = new SQLite3("DB/users.db");
//$db->exec("CREATE TABLE posts(id INTEGER PRIMARY KEY, user TEXT, picture TEXT, coords TEXT, status TEXT, comment TEXT)");
//$db->exec("CREATE TABLE users(userid TEXT, name TEXT, email TEXT,privileges TEXT,rating FLOAT, comments TEXT)");
//$db->exec("INSERT INTO users(userid, name, email, privileges, rating, comments) VALUES('Test Person', 'Test@test.se', '123', 'admin', 3.5, 'test comment')");


$dbdata = new DatabaseCommunicator();


//Examples on how to call functions 
//$dbdata-> AddUserInDatabase($_GET['id'], $_GET['email'], $_GET['name'], "user", 0, "comment")
//$dbdata->AddPostInDatabase("test user", "/img/picture", "long: 34.33, lat: 23,33", "OPEN", "Bla bla bla comment");
//$dbdata->ChangeStatusOfPost(1, "OPENED");
//$dbdata->ChangeRatingOfUser("3035821783128324", 4.22)
//$dbdata->GetAllPosts();

/*
session_start();
//Set the current session email, name and ID of user 
$_SESSION['name'] = $_GET['name'];
$_SESSION['email'] = $_GET['email'];
$_SESSION['id'] = $_GET['id'];
*/


?>